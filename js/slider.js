document.onkeydown = checkKeycode;

var celulas = new Array();
celulas[0] = "um";
celulas[1] = "dois";
celulas[2] = "tres";
celulas[3] = "quatro";
celulas[4] = "cinco";
celulas[5] = "seis";
celulas[6] = "sete";
celulas[7] = "oito";
celulas[8] = "nove";
celulas[9] = "dez";

var index = 0;

function init()
{
  $("div").css({"visibility" : "hidden"});
}
function next()
{
  if($("#" + celulas[index]).length > 0)
  {
    $("#" + celulas[index]).css({"visibility":"visible"});
    index += 1;
  }
  else
    window.location = './?sldno=' + nPage;
}
function prev()
{
  if($("#" + celulas[index]).length > 0)
  {
    $("#" + celulas[index]).css({"visibility":"visible"});
    index += 1;
  }
  else
    window.location = './?sldno=' + pPage;
}

function checkKeycode(e) {
  var keycode;
  if (window.event)
    keycode = window.event.keyCode;
  else if(e)
    keycode = e.which;
  if(keycode == 37)
    prev();
  else if(keycode == 39)
    next();
}
