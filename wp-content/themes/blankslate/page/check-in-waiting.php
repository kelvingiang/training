<?php
//Template Name: Page Check In Waiting
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
        <?php // suite_seo(); ?>
        <?php wp_head(); ?>
    </head>

    <body>

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
                <div class=" col-lg-12" style="text-align: center; height:300px; line-height: 300px;" >
                    <label ID="waiting_txt"><?php echo get_option('check_in_waitting'); ?></label>              
                </div>

            </div>
        </div>
    </body>

    <style>
        #waiting_txt{
            font-size:50px;
            font-weight: bold;
            letter-spacing: 10px;
            -webkit-animation-name: example; /* Safari 4.0 - 8.0 */
            -webkit-animation-duration: 10s; /* Safari 4.0 - 8.0 */
            -webkit-animation-iteration-count: infinite; /* Safari 4.0 - 8.0 */
            animation-name: example;
            animation-duration: 10s;
            animation-iteration-count: infinite;

        }


        /* Safari 4.0 - 8.0 */
        @-webkit-keyframes example {
            0%   {color:#333; font-size: 60px}
            20%   {color:#333; font-size: 60px}
            40%  {color:#FC9105; font-size: 72px}
            41%  {color:#FC9105; font-size: 70px}
            42%  {color:#FC9105; font-size: 71px}
            50%  {color:#FC9105; font-size: 70px}
            70%  {color:#FC9105; font-size: 70px}
            100% {color:#333; font-size: 60px;}
        }

        /* Standard syntax */
        @keyframes example {
            0%   {color:#333; font-size: 60px}
            20%   {color:#333; font-size: 60px}
            40%  {color:#FC9105; font-size: 72px}
            41%  {color:#FC9105; font-size: 70px}
            42%  {color:#FC9105; font-size: 71px}
            50%  {color:#FC9105; font-size: 70px}
            70%  {color:#FC9105; font-size: 70px}
            100% {color:#333; font-size: 60px;}
        }
    </style>




