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
  if(vv == 1)
    $("div").css({"display" : "none"});
  $("#sldMenu").css({"display" : "inline"});
  $("#sldContent").css({"display" : "inline"});
  $("#sldController").css({"display" : "inline"});
  $("#sldContent").css({"height" : "560px"});
}
function next()
{
  if($("#" + celulas[index]).length > 0)
  {
    if(vv != 0)
    {
      $("#" + celulas[index]).fadeIn('slow');
      index += 1;
    }
    else
      window.location = './?sldno=' + nPage + '&vv=' + 1;
  }
  else
    window.location = './?sldno=' + nPage + '&vv=' + 1;
}
function prev()
{
    window.location = './?sldno=' + pPage + '&vv=' + 0;
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

