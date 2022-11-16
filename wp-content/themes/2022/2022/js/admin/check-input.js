$(document).ready(function() {

    function checkNumber() {
        $("#m_phone").keyup(function() {
            var $this = $(this);
            $this.val($this.val().replace(/[^\d.]/g, ''));
        }
        );
    }
});


function keypress_number(e) {
    var keypressed = null;
    if (window.event)
    {
        keypressed = window.event.keyCode; //IE
    }
    else {

        keypressed = e.which; //NON-IE, Standard
    }
    if (keypressed < 48 || keypressed > 57)
    {
        if (keypressed === 8 || keypressed === 127)
        {
            return;
        }
        return false;
    }
}

function keypress_float(e) {
    var keypressed = null;
    if (window.event)
    {
        keypressed = window.event.keyCode; //IE
    }
    else {
        keypressed = e.which; //NON-IE, Standard
    }
    if ((keypressed < 48 || keypressed > 57) && keypressed === 190)
    {
        if (keypressed === 8 || keypressed === 127)
        {
            return;
        }
        return false;
    }
}

 function isNumberKey(evt)
 {
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
 return false;
 return true;
 }


function num(){ 
  var ele = document.querySelectorAll('.number-only')[0];
  ele.onkeypress = function(e) {
     if(isNaN(this.value+""+String.fromCharCode(e.charCode)))
        return false;
  };
  ele.onpaste = function(e){
     e.preventDefault();
  };
}

num();

