<?php

  function setAllJs()
  {
    $js[] = "jquery.js";
    $js[] = "slider.js";
    //$js[] = "";

    $jsDir = "./js/";
	$code = "";

	$s = count($js);
	for($i = 0; $i < $s; $i += 1)
      $code .= "<script type=\"text/javascript\" language=\"JavaScript\" src=\"" . $jsDir . $js[$i] . "\"></script>\n";
	return $code;
  }

  function setNPPage($actPage)
  {
    $code = "<script type=\"text/javascript\" language=\"JavaScript\">var nPage=" . ($actPage + 1) . ";var pPage=" . ($actPage - 1) . ";</script>\n";
	echo $code;
  }

  function parseGetBody($code)
  {
    $code = explode("<body>", $code);
	$code = explode("</body>", $code[1]);
	return $code[0];
  }

  function getSrc($file)
  {
    $src = file($file);
	$src = implode("", $src);
	$src = utf8_encode($src);
	return $src;
  }

  function getSlideController()
  {?>
    <a href="javascript:prev();"><< Anterior</a> | 
	<a href="javascript:next();">Próximo >></a>
  <?}

?>