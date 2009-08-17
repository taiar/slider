<?

  class slider
  {

    /**
     * Cada slide terÃ¡ um ID unico esse array relaciona o id unico com a pasta de cada um
     * @var Array
     */
    private $slides;

    /**
     * DiretÃ³rio aonde se encontram os slides
     * @var string
     */
    private $sldsDir;

    /**
     * Arquivo com as configuracoes dos slides
     * @var String
     */
    private $sldsCfg;

    /**
     * Arquivo que carrega a estrutura do menu
     * @var String
     */
    private $menuArq;

    /**
     * Id do slide em questao
     * @var Unsigned Integer
     */
    private $id;

    /**
     * Indica a pagina atual do slide em questao
     * @var Unsigned Integer
     */
    private $page;

    /**
     * Define a direcao do slide
     * 1 = avancando
     * 2 = retrocedendo
     * @var Binary
     */
    private $direction;

    /**
     * Seta as variaveis globais de funcionamento
     * @param Unsigned Integer $id
     */
    public function __construct($id = '', $page = '', $direcao = '')
    {
      if($id != "" || $id == '0') $this->id = $id;
      if($page != "" || $page == '0') $this->page = $page;
      if($direcao != "" || $id == '0') $this->direction = $direcao;

      $this->sldsDir = "./slides/";
      $this->sldsCfg = "sldCfg.php";
      $this->menuArq = "menuCfg.php";

      $this->slides = array();
      $this->slides[0] = "sld1dad";
    }

    public function getSldDir()
    {
      $arq = $this->sldsDir . $this->slides[$this->id] . "/";
      return $arq;
    }

    public function getSldCfg()
    {
      $arq = $this->getSldDir() . $this->sldsCfg;
      return $arq;
    }

    public function getSldPage()
    {
      $arq = $this->page;
      return $arq;
    }

    public function getSldMenuArq()
    {
      $arq = $this->getSldDir() . $this->menuArq;
      return $arq;
    }

    public function setAllJs()
    {
      $js[] = "jquery.js";
      $js[] = "slider.js";
      //$js[] = "";

      $jsDir = "./js/";
      $code = "";

      $s = count($js);

      for($i = 0; $i < $s; $i += 1)
        $code .= "<script type=\"text/javascript\" language=\"JavaScript\" src=\"" . $jsDir . $js[$i] . "\"></script>\n  ";

      return $code;
    }

    public function setNPPage()
    {
      if(($this->page + 1) > SLDMAX)
        $nPage = 0;
      else
        $nPage = $this->page + 1;

      if(($this->page - 1) < 0)
        $pPage = SLDMAX;
      else
        $pPage = $this->page - 1;

      $code = "<script type=\"text/javascript\" language=\"JavaScript\">var nPage=" . $nPage . ";var pPage=" . $pPage . ";var vv=" . $this->direction . ";</script>\n";
      echo $code;
    }

    public function getHeaders()
    {
      echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">";
      echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/default.css\">";
      echo $this->setNPPage();
      echo $this->setAllJs();
    }

    public function parseGetBody($code)
    {
      $code = explode("<body>", $code);
      $code = explode("</body>", $code[1]);
      return $code[0];
    }

    public function getSrc($file)
    {
      $src = file($file);
      $src = implode("", $src);
      $src = utf8_encode($src);
      return $src;
    }

    public function getSlideController()
    {
      echo "<div id=\"sldController\">";
      echo "<a href=\"javascript:prev();\"><< Anterior</a> | ";
      echo "<a href=\"javascript:next();\">Próximo >></a>";
      echo "</div>";
    }

    public function getMenu()
    {
      $menuF = $this->sldsDir . $this->slides[$this->id] . "/" . $this->menuArq;
      if(is_file($menuF))
        $this->mostraMenu();
      else
      {
        $this->geraArquivo();
        echo $this->mostraMenu();
      }
    }

    public function mostraMenu()
    {
      $code = "<div id=\"sldMenu\"><ul>";
      $menuArq = $this->getSldDir() . $this->menuArq;
      $caps = file($menuArq);
      for($i=0;$i<SLDMAX;$i+=1)
      {
        $class = "";
        if(($i + 1) == $this->page) $class = " class=\"onnn\"";
        $code .= "<li><a href=\"?sldno=" . ($i + 1) . "\"" . $class . ">(" . ($i + 1) . ") " . $caps[$i] . "</a></li>";
      }
      $code .= "</ul></div>";
      echo $code;
      return $code;
    }

    public function geraArquivo()
    {
      $opDir = $this->sldsDir . $this->slides[$this->id] . "/";
      $tArr = array();

      for($i=1;$i<=SLDMAX;$i++)
      {
        $code = $this->RreadFile($opDir . $i . ".html");
        ereg("\<h1\>(.*)\<\/h1\>", $code, $reg);
        //FIXME: isso deveria ser feito por uma outra funcao, talvez em uma outra classe UTIL
        $tArr[] = str_replace("  ", " ", str_replace("  ", " ", str_replace("\t", " ", trim(str_replace("\r\n", "", strip_tags(utf8_encode($reg[0])))))));
      }

      $f = fopen($this->getSldDir() . $this->menuArq, "w");

      for($i=0;$i<SLDMAX;$i+=1)
        fwrite($f, $tArr[$i] . "\n");
      fclose($f);
    }

    public function RreadFile($file)
    {
      $cont = implode("", file($file));
      return $cont;
    }

  } // END CLASS

?>