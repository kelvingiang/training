<?php
//Template Name: Page Check In
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link type="image/x-icon" href="/favicon.ico" rel="icon"> <!-- icon show on web title -->
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon" />

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
    <?php wp_head(); ?>
</head>

<body>
    <div class="my-waiting">
        <img src="<?php echo PART_IMAGES . 'loading_pr2.gif' ?>" style=" width: 150px" />
    </div>


    <div class="check-in-space">
        <div class="header">
            <div class="logo">
                <img src="<?php echo PART_IMAGES . 'logoctcvn.png' ?>" alt="ctcvn_logo" title="ctcvn_logo" />
                <div>
                    <h2>越南台灣商會聯合總</h2>
                    <h3>THE COUNCIL OF TAIWANESE CHAMBERS OF COMMERCE IN VIETNAM </h3>
                </div>
            </div>
            <div class="title">
                <h1><?php echo get_option('Title_text'); ?></h1>
            </div>
        </div>

        <div class="content">
            <div class="content-form">
                <div>
                    <form name="check-form" id="check-form" method="post" action="">
                        <input type="text" id="txt-barcode" name="txt-barcode" placeholder="輸入條碼" required />
                        <input type="submit" id="btn-submit" name="btn-submit" value="<?php _e('Submit'); ?>" />
                    </form>
                </div>
                <div>
                    <?php get_template_part("templates/template", "ad-logo");
                    ?>
                </div>
            </div>
            <div class="content-info">
                <div class="content-welcome">
                    <div>
                        <h2>歡迎光臨</h2>
                        <div id="last-check-in"> </div>
                    </div>
                    <div>
                        <img src="<?php echo PART_IMAGES . 'digiwin_logo.png'; ?>" /> </br>
                        <h3>鼎捷軟件(越南)維護製作</h3>
                    </div>
                </div>
                <div id="barcode-error">條 碼 不 正 確 ! </div>
                <div id="barcode-unactive">您 的 帳 號 還 沒 啟 用! </div>
                <div id="guest-main">
                    <div class="guest-img">
                        <div id="guest-picture"> </div>
                    </div>

                    <div class="guest-info">
                        <div>
                            <label>姓 名 : </label>
                            <label id="guest_name">&nbsp;</label>
                        </div>
                        <div>
                            <label>職 稱 : </label>
                            <label id="guest_position">&nbsp;</label>
                        </div>
                        <div>
                            <label>分 會 : </label>
                            <label id="guest_country">&nbsp;</label>
                        </div>
                        <div>
                            <label>電 郵 : </label>
                            <label id="guest_email">&nbsp; </label>
                        </div>
                        <div>
                            <label>電 話 : </label>
                            <label id="guest_phone">&nbsp;</label>
                        </div>
                        <div>
                            <label>備 註 :</label>
                            <label class="guest_note">&nbsp;</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#txt-barcode").focus();

        jQuery('#check-form').submit(function(e) { //     console.log(objInfo);
            var barcode = jQuery('#txt-barcode').val();
            jQuery('.my-waiting').css('display', 'block');


            jQuery.ajax({
                url: '<?php echo get_template_directory_uri() . '/ajax/updata-checkin.php' ?>', // lay doi tuong chuyen sang dang array
                type: 'post', //                data: $(this).serialize(),
                data: {
                    id: barcode
                },
                dataType: 'json',
                success: function(
                    data) { // set ket qua tra ve  data tra ve co thanh phan status va message
                    if (data.status === 'done') {
                        jQuery("#txt-barcode").val('');
                        //window.location.reload();  
                        jQuery('#barcode-error, #barcode-unactive').css('display', 'none');
                        jQuery('#last-check-in, #guest-main').css('display', 'flex');
                        jQuery('#last-check-in').children().remove();
                        if (data.info.TotalTimes !== null) {
                            jQuery('#last-check-in').append("<label>登入次數 : " + data.info
                                .TotalTimes + " 次  </label>");
                            jQuery('#last-check-in').append("<label>上次登入 : " + data.info
                                .LastCheckIn + "</label>");
                        }
                        jQuery('#guest_name').text(data.info.FullName);
                        jQuery('#guest_position').text(data.info.Position);
                        jQuery('#guest_country').text(data.info.Country);
                        jQuery('#guest_email').text(data.info.Email);
                        jQuery('#guest_phone').text(data.info.Phone);
                        jQuery('#guest_note').text(data.info.Note);
                        jQuery('#guest-pic').remove();
                        jQuery('#guest-picture').append(data.info.Img);
                        //window.location.reload();
                        window.setTimeout(function() {
                            jQuery('.my-waiting').css('display', 'none');
                        }, 100);

                    } else if (data.status === 'error') {
                        jQuery("#txt-barcode").val('');
                        jQuery('#guest-main, #last-check-in, #barcode-unactive').css('display',
                            'none');
                        jQuery('#barcode-error').css('display', 'block');
                        window.setTimeout(function() {
                            jQuery('.my-waiting').css('display', 'none');
                        }, 100);
                    } else if (data.status === "unactive") {
                        jQuery("#txt-barcode").val('');
                        jQuery('#guest-main, #last-check-in, #barcode-error').css('display',
                            'none');
                        jQuery('#barcode-unactive').css('display', 'block');
                        window.setTimeout(function() {
                            jQuery('.my-waiting').css('display', 'none');
                        }, 100);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.reponseText);
                    //console.log(data.status);
                }
            });
            e.preventDefault();
        });
    });
</script>