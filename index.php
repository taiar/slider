<?php

  if(isset($_GET["sldid"]))
    $sld = $_GET["sldid"];
  else
    $sld = 0;

  if(isset($_GET["sldno"]))
    $page = $_GET["sldno"];
  else
    $page = 0;

  if(isset($_GET["vv"]))
    $vv = $_GET["vv"];
  else
    $vv = 1;

  require "slider.class.php";

  $slide = new slider($sld, $page, $vv);
  require($slide->getSldCfg());
  // require($slide->getSldMenuArq());

  //===================================================
  //  Monta o cabeçalho da página
  //  1 - Precisa fazer um parse para retirar o TITLE do slide
  //  2 - Precisa escolher uma codificação padrão (provavelmente vamos trabalhar com UTF-8)
  //===================================================

  //===================================================
  //  Monta o Corpo da página
  //  1 - Precisa fazer um parse para pegar o conteúdo da página
  //  2 - Imprime o conteúdo da página formatado // PRONTO!
  //  3 - Criar um índice no canto direito com o menu de slides para navegação
  //===================================================

  //===================================================
  //  Monta o Rodapé da página
  //  1 - Fazer o controller dos slides JS
  //  2 - Fazer uma interface para controle de slides
  //  3 - Fazer um sistema de interação pelo teclado // PRONTO!
  //===================================================

  $slide->getHeaders();
  $sldContents = $slide->parseGetBody($slide->getSrc($slide->getSldDir() . $slide->getSldPage() . ".html"));
  ereg("\<h1\>(.*)\<\/h1\>", $sldContents, $reg);
?>

  <body onload="init();">
  <?=$reg[0];?>
  <div id="sldContent">
  <?
    $sldContents = ereg_replace("\<h1\>(.*)\<\/h1\>", "", $sldContents);
    $sldContents = str_replace("<img src=\"", "<img src=\"" . $slide->getSldDir() . "/", $sldContents);
    echo $sldContents;
  ?>
  </div>
  <?=$slide->getMenu();?>
  <? $slide->getSlideController(); ?>