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
      $code .= "<script type=\"text/javascript\" language=\"JavaScript\" src=\"" . $jsDir . $js[$i] . "\"></script>\n  ";
	return $code;
  }

  function setNPPage($actPage)
  {
    if(($actPage + 1) > SLDMAX) 
      $nPage = 1; 
    else
      $nPage = $actPage + 1;

    if(($actPage - 1) < 1) 
      $pPage = SLDMAX; 
    else
      $pPage = $actPage - 1; 
	$code = "<script type=\"text/javascript\" language=\"JavaScript\">var nPage=" . $nPage . ";var pPage=" . $pPage . ";</script>\n";
	echo $code;
  }

  function getHeaders($page)
  {?>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/default.css">
    <?=setNPPage($page);?>
    <?=setAllJs();?>
  <?}

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