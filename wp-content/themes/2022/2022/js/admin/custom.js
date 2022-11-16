jQuery(document).ready(function () {
  // PHAN GUEST CHECK IN LOAI BO CHECK IN
  jQuery(".uncheck_in").click(function (e) {
    var itemID = jQuery(this).attr("data_id");
    var objUrl = checkin;
    jQuery.ajax({
      url: objUrl.url, // lay doi tuong chuyen sang dang array
      type: "post",
      data: { id: itemID },
      dataType: "json",
      cache: false,
      success: function (data) {
        // set ket qua tra ve  data tra ve co thanh phan status va message
        if (data.status === "done") {
          // console.log(data);
          // $('#likeResult').text(data.like);

          location.reload();
        } else if (data.status === "error") {
          $("#mess").text(data.message);
        }
      },
      error: function (xhr) {
        console.log(xhr.reponseText);
      },
    });
    e.preventDefault();
  });

  // datapicker NAY CHI SHOW MMDD KHONG CO YYYY
  //  NGOAI VIEC KHAI BAO TAI DAY CON KHAI BAO TAI  CSS DE HIDE
  //  .ui-datepicker-year{ display: none;} TAI FILE admin-style.css
  jQuery(".MyDateNoYear").datepicker({
    dateFormat: "dd-mm",
    changeMonth: true,
    changeYear: false,
  });

  jQuery(".MyDate").datepicker({
    dateFormat: "dd-mm-yy",
    changeMonth: true,
    changeYear: true,
  });

  jQuery(".selectmenu").selectmenu({});

  //KIEM TRA CHI CHO NHAP NUMBER
  jQuery(".type-number").keypress(function (event) {
    return isOnlyNumber(event, this);
  });
  function isOnlyNumber(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
  }

  // KIEM TRA KIEU DU LA PHONE
  jQuery(".type-phone").keypress(function (event) {
    return isPhone(event, this);
  });
  function isPhone(evt, element) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (
      (charCode != 45 || $(element).val().indexOf("-") != -1) && // “-” CHECK MINUS, AND ONLY ONE.
      (charCode != 46 || $(element).val().indexOf(".") != -1) && // “.” CHECK DOT, AND ONLY ONE.
      charCode != 8 && // “.” CHECK DOT, AND ONLY ONE.
      (charCode < 48 || charCode > 57)
    )
      return false;
    return true;
  }

  // KIEM TRA KIEU DU LIEU LA TIME
  jQuery(".type-time").keypress(function (event) {
    return isTime(event, this);
  });
  function isTime(evt, element) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (
      charCode != 8 &&
      (charCode != 58 || $(element).val().indexOf("-") != -1) && // “-” CHECK MINUS, AND ONLY ONE.
      (charCode < 48 || charCode > 57)
    )
      return false;
    return true;
  }

  jQuery(".email").focusout(function (e) {
    var email = document.getElementById("txt_email");
    var filter =
      /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email.value)) {
      jQuery("#error-email").text("請輸入正確 E-mail 地址 ! ");
      email.focus;
    } else {
      jQuery("#error-email").text("");
    }
  });

  jQuery(".type-phone-more").keypress(function (event) {
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

  // KIEM TRA XOA NHIEU DOI TUONG CUNG LUC
  jQuery("#doaction").click(function () {
    var value = $("#bulk-action-selector-top option:selected").val();
    if (value === "delete") {
      MyConfirm();
    }
  });

  // ADD 26/04/16
  // KIEM BUTTON SUBMIT CUA THAO TAC HANG LOAT
  // BUTTON O TREN GIRD
  jQuery("#doaction").attr("disabled", "disabled");
  //    $('#filter_action').attr('disabled', 'disabled');

  jQuery('input[type="checkbox"]').click(function () {
    if (jQuery(this).prop("checked") == true) {
      jQuery("#doaction").prop("disabled", false);
      //          $('#filter_action').prop('disabled', false);
    } else if (jQuery(this).prop("checked") == false) {
      jQuery("#doaction").prop("disabled", true);
      //        $('#filter_action').prop('disabled', true);
    }
  });
});

function MyConfirm() {
  var x;
  if (confirm("您確定刪除這畢資料!") === true) {
    setCookie("del", "true", 1);
  } else {
    setCookie("del", "false", 1);
  }
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  var expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
