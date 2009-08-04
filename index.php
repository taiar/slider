<?php

  if(isset($_GET["sldid"]))
    $sld = $_GET["sldid"];
  else
    $sld = 0;

  if(isset($_GET["sldno"]))
    $page = $_GET["sldno"];
  else
    $page = 1;

  require "functions.php";
  require "config.php";
  require $sldsDir . $slides[$sld] . "/sldCfg.php";

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
?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<?=setNPPage($page);?>
<?=setAllJs();?>
<body onload="init();">
<?=parseGetBody(getSrc($sldsDir . $slides[$sld] . "/" . $page . ".html"));?>
<?=getSlideController();?>