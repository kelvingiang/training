<?php
//Template Name: Page Check In
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">    
        <link type="image/x-icon" href="/favicon.ico" rel="icon"> <!-- icon show on web title -->
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon"/>

        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <!-- B--- phan cho bootstrap -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- E --- phan bootstrap ------------->
        <!--[if lt IE 9]>
        <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
        <![endif]-->
              <!-- them jquery tu google    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
        <meta name="geo.region" content="VN" />
        <meta name="geo.position" content="10.725377;106.720064" />
        <meta name="ICBM" content="10.725377, 106.720064" />
        <?php //suite_seo(); ?>
        <?php wp_head(); ?>
    </head>

    <body>
        <div class="my-waiting">
            <img src="<?php echo get_image('loading_pr2.gif') ?>"  style=" width: 150px" />
        </div>
        <div class="container-fluid" style="background-color: white; height: 100vh; padding: 0px 20px" >
            <div id="loggo" style="margin: 2px 0">
                <a style=" float: left"  href="<?php echo home_url() ?>" >
                    <img src="<?php echo get_image('logo.png') ?>" alt="logo" title="logo" style="width: 70px; margin: 10px"/>
                </a> 
                <h1 style=" float: left; font-size: 25px; padding-top: 8px; color: #3C5AA1; font-weight: bold">同奈台灣商會</h1>
            </div>
            <div class="row" style="padding-top:  75px">
                <div class="col-lg-12" style="height: 70px; background-color:  #FC9105; border-radius: 5px;  margin-bottom: 10px ">
                    <h1 style="font-weight:  bold; color: white; letter-spacing: 3px"><?php echo get_option('check_in_title'); ?></h1>
                </div>    
                <div class=" col-lg-3" >
                    <div style="background-color:  #D1D4D6;  height: 45px; padding: 5px 0 0 8px">
                        <form name="check-form" id="check-form" method="post" action="">
                            <input type="text" id="txt-barcode" name="txt-barcode" placeholder="輸入條碼" style="width: 70%;  height: 33px"/>
                            <input type="submit" id="btn-submit" name="btn-submitbarcode"  value="<?php _e('Submit'); ?>" class="btn"/>
                        </form>
                    </div>
                    <div style="margin-top:5px">
                        <?php get_template_part("template", "ad-logo"); ?>
                    </div>
                </div>
                <div class="col-lg-9" style="border-left: 1px #D1D4D6 solid">
                    <div class='col-lg-12' style=' margin-bottom: 20px;min-height: 80px; color: #666;  border-bottom: 2px #666 dotted; float: left' >
                        <div class="col-lg-6" style="float: left; width: 350px">
                            <h2 style="font-weight:bold;  color: #FC9105" > 歡 迎 光 臨 </h2>
                            <div id="last-check-in"> </div>
                        </div>
                        <div class="col-lg-6" style="padding-top: 10px; float: right">
                            <img src="<?php echo get_image('digiwin_logo.png'); ?>"/> </br>
                            <label style="font-size: 25px; font-weight: bold; padding-left: 10px;color: #FC9105">鼎 捷 軟 件 維 護 製 作</label>
                        </div>

                    </div>
                    <div class="col-lg-12" id="barcode-error">條 碼 不 正 確 ! </div>
                    <div class="col-lg-12" id="barcode-unactive">您的帳號還沒啟用 ! </div>
                    <div class="col-lg-12" id="guest-main">
                        <div class="col-lg-5">
                            <div id="guest-pictrue"> </div>
                        </div>

                        <div class="col-lg-7" style="padding-left: 70px; float:  left ; font-size: 15px"> 
                            <div class="guest-info guest-name">
                                <div><label>姓 名 :</label></div>
                                <div><label id="guest_name">&nbsp;</label></div>
                            </div>
                            <div class="guest-info">
                                <div><label>職 稱 :</label></div>
                                <div><label id="guest_position">&nbsp;</label></div>
                            </div>
                            <div class="guest-info">
                                <div><label>公司名稱 : </label></div>
                                <div><label id="guest_company">&nbsp;</label></div>
                            </div>
                            <div class="guest-info">
                                <div><label>E-mail :</label></div>
                                <div><label id="guest_email">&nbsp;</label></div>
                            </div>

                            <div class="guest-info">
                                <div><label>聯 絡 電 話 :</label></div>
                                <div><label id="guest_phone">&nbsp;</label></div>
                            </div>

                            <div class="guest-info">
                                <div><label>備 註 :</label></div>
                                <div><label class="guest_note">&nbsp;</label></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>



    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery("#txt-barcode").focus();

            jQuery('#check-form').submit(function (e) {             //     console.log(objInfo);
                var barcode = jQuery('#txt-barcode').val();
                jQuery('.my-waiting').css('display', 'block');


                jQuery.ajax({
                    url: '<?php echo get_template_directory_uri() . '/ajax/updata-checkin.php' ?>', // lay doi tuong chuyen sang dang array
                    type: 'post', //                data: $(this).serialize(),
                    data: {id: barcode},
                    dataType: 'json',
                    success: function (data) {  // set ket qua tra ve  data tra ve co thanh phan status va message
                        if (data.status === 'done') {
                            jQuery("#txt-barcode").val('');
                            //window.location.reload();  
                            jQuery('#barcode-error, #barcode-unactive').css('display', 'none');
                            jQuery('#guest-main, #last-check-in').css('display', 'block');
                            jQuery('#last-check-in').children().remove();
                            if (data.info.TotalTimes !== null) {
                                jQuery('#last-check-in').append("<h5>登入次數 : " + data.info.TotalTimes + " 次  </h5>");
                                jQuery('#last-check-in').append("<h5>上次登入 : " + data.info.LastCheckIn + "</h5>");
                            }
                            jQuery('#guest_name').text(data.info.FullName);
                            jQuery('#guest_position').text(data.info.Position);
                            jQuery('#guest_company').text(data.info.Company);
                            jQuery('#guest_email').text(data.info.Email);
                            jQuery('#guest_phone').text(data.info.Phone);
                            jQuery('#guest_note').text(data.info.Note);
                            jQuery('#guest-pic').remove();
                            jQuery('#guest-pictrue').append(data.info.Img);
                            //window.location.reload();
                            window.setTimeout(function () {
                                jQuery('.my-waiting').css('display', 'none');
                            }, 100);

                        } else if (data.status === 'error') {
                            jQuery("#txt-barcode").val('');
                            jQuery('#guest-main, #last-check-in, #barcode-unactive').css('display', 'none');
                            jQuery('#barcode-error').css('display', 'block');
                            window.setTimeout(function () {
                                jQuery('.my-waiting').css('display', 'none');
                            }, 100);
                        } else if (data.status === "unactive") {
                            jQuery("#txt-barcode").val('');
                            jQuery('#guest-main, #last-check-in, #barcode-error').css('display', 'none');
                            jQuery('#barcode-unactive').css('display', 'block');
                            window.setTimeout(function () {
                                jQuery('.my-waiting').css('display', 'none');
                            }, 100);
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.reponseText);
                        //console.log(data.status);
                    }
                });
                e.preventDefault();
            });
        });
    </script>

    <style  type="text/css">
        .guest-info{
            clear: both;
        }
        .guest-info div:first-child{
            min-width: 100px;
        }
        .guest-info div {
            float: left;
        }
        .guest-name{
            font-size: 20px; 
            font-weight: bold;
            color:#FC9105
        }
        #guest-pic{
            width: 350px;
            margin-left: -20px; 
            margin-top: 5px;
            border: 1px solid #999999;
            border-radius: 3px;
        }
        #last-check-in h5 {
            font-weight: bold
        }
        #barcode-error, #barcode-unactive{
            display: none;
            font-size:  30px;
            font-weight: bold;
            color: red;
        }

        .my-waiting{
            display: none;
            background-color:  rgba(0, 0, 0, 0.7);
            position:  absolute;
            top: 0px;
            width: 100%;
            height: 100%;
            text-align:  center;
            padding-top: 20%;
            z-index: 5000;
        }
    </style>
