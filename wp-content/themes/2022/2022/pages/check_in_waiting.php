<?php
//Template Name: Page Check In Waiting
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
    <?php suite_seo(); ?>
    <?php wp_head(); ?>
</head>

<body>

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
        <div>
            <div class=" col-lg-12" style="text-align: center; height:300px; line-height: 300px;">
                <label ID="waiting_txt"><?php echo get_option('Waiting_text'); ?></label>
            </div>

        </div>
    </div>
</body>

<style>
    #waiting_txt {
        text-shadow: 2px 2px 8px #000000;
        padding-top: 8%;
        font-weight: bold;
        letter-spacing: 10px;
        -webkit-animation-name: example;
        /* Safari 4.0 - 8.0 */
        -webkit-animation-duration: 5s;
        /* Safari 4.0 - 8.0 */
        -webkit-animation-iteration-count: infinite;
        /* Safari 4.0 - 8.0 */
        animation-name: example;
        animation-duration: 5s;
        animation-iteration-count: infinite;

    }


    /* Safari 4.0 - 8.0 */
    @-webkit-keyframes example {
        0% {
            color: #fff;
            font-size: 10rem
        }



        50% {
            color: #057cfc;
            font-size: 15rem
        }



        100% {
            color: #fff;
            font-size: 10rem
        }
    }

    /* Standard syntax */
    /* @keyframes example {
        0% {
            color: #333;
            font-size: 60px
        }

        20% {
            color: #333;
            font-size: 60px
        }

        40% {
            color: #FC9105;
            font-size: 72px
        }

        41% {
            color: #FC9105;
            font-size: 70px
        }

        42% {
            color: #FC9105;
            font-size: 71px
        }

        50% {
            color: #FC9105;
            font-size: 70px
        }

        70% {
            color: #FC9105;
            font-size: 70px
        }

        100% {
            color: #333;
            font-size: 60px;
        }
    } */
</style>