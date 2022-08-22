jQuery(document).ready(function () {
  //KIEM TRA CHI CHO NHAP NUMBER
  jQuery(".type-number").keypress(function (event) {
    return isOnlyNumber(event, this);
  });
  function isOnlyNumber(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
  }

  jQuery(".type-number-dot").keypress(function (event) {
    return isNumberDot(event, this);
  });
  function isNumberDot(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if ((charCode < 48 || charCode > 57) && charCode != 46) return false;
    return true;
  }

  jQuery(".type-phone").keypress(function (event) {
    return isPhone(event, this);
  });
  function isPhone(evt, element) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (
      //(charCode != 45 || jQuery(element).val().indexOf('-') != -1) && // “-” CHECK MINUS, AND ONLY ONE.
      charCode != 45 && // “-” CHECK MINUS, AND MORE.
      (charCode != 46 || jQuery(element).val().indexOf(".") != -1) && // “.” CHECK DOT, AND ONLY ONE.
      charCode != 8 && // “.” CHECK DOT, AND ONLY ONE.
      (charCode < 48 || charCode > 57)
    )
      return false;
    return true;
  }

  // KIEM TRA NHAP EMAIL
  jQuery(".type-email").focusout(function (e) {
    //var email = document.getElementById("txt-email");
    var email = jQuery(this).val();
    var filter =
      /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email.value)) {
      jQuery("#error-email").text("請輸入正確 E-mail 地址 ! ");
      email.focus;
    } else {
      jQuery("#error-email").text("");
    }
  });

  // KIEM TRA NHAP DIA CHI WEBSITE
  jQuery(".type-website").focusout(function (e) {
    var value = jQuery(this).val().replace(/\s+/g, ""); // LOAI BO CAC KHOANG TRANG

    if (
      value.toLowerCase().indexOf("http:") >= 0 ||
      value.toLowerCase().indexOf("https:") >= 0
    ) {
      jQuery(this).val(value);
    } else {
      jQuery(this).val("http://" + value);
    }
  });

  jQuery(".type-time").keyup(function (event) {
    jQuery(this).attr("maxlength", "5");
    var charCode = event.which ? event.which : event.keyCode;
    if (charCode != 8 && charCode != 46) {
      if (jQuery(this).val().length === 2) {
        var tt = jQuery(this).val() + ":";
        jQuery(this).val(tt);
      }
    }
    if (
      jQuery(this).val().length === 3 &&
      jQuery(this).val().indexOf(":") <= 0
    ) {
      var arr = jQuery(this).val().split("");
      jQuery(this).val(arr[0] + arr[1] + ":" + arr[2]);
    }
  });

  //KIEM TRA NHAP DU LIEU RONG
  function isName($class) {
    if ($class == ".type-text") {
      jQuery(".type-text").focusout(function (e) {
        var name = document.getElementById("txt-name");
        if (!jQuery(name).val()) {
          //is empty
          jQuery("#error-name").text("Please enter commerce name! ");
          name.focus();
        } else {
          jQuery("#error-name").text(" ");
        }
      });
    }
  }
  function isAddress($class) {
    if ($class == ".type-text") {
      jQuery(".type-text").focusout(function (e) {
        var address = document.getElementById("txt-address");
        if (!jQuery(address).val()) {
          //is empty
          jQuery("#event_title_merss").text("Please enter commerce address! ");
          address.focus();
        } else {
          jQuery("#event_title_merss").text(" ");
        }
      });
    }
  }
  var onSelectChange = function () {
    isName(".type-text");
    isAddress(".type-text");
  };
  jQuery(".type-text").change(onSelectChange);
});
