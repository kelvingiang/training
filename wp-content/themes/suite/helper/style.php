<?php

// QUAN LY CAC PHAN CSS VA JS CHO ADMIN VA CLINET
// PHAN BIET ADD VO PHAN ADMIN HAY CLIENT
function style_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        //==== PHAN CLIENT================================================================ 
        wp_register_style('bootstrap-style-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0', 'all');
        wp_enqueue_style('bootstrap-style-css');

        wp_register_style('bootstrap-theme-css', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '1.0', 'all');
        wp_enqueue_style('bootstrap-theme-css');

        wp_register_style('font-awesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '1.0', 'all');
        wp_enqueue_style('font-awesome-css');

        // wp_register_style('menu-style-css', get_template_directory_uri() . '/css/menu/superfish-custom.css', array(), '1.0', 'all');
        // wp_enqueue_style('menu-style-css');

        wp_register_style('my-style-css', get_template_directory_uri() . '/css/client/my-style.css', array(), '1.0', 'all');
        wp_enqueue_style('my-style-css');

        wp_register_style('responsive-css', get_template_directory_uri() . '/css/responsive.css', array(), '1.0', 'all');
        wp_enqueue_style('responsive-css');

        wp_register_style('mobile-menu-css', get_template_directory_uri() . '/css/menu/mobile.css', array(), '1.0', 'all');
        wp_enqueue_style('mobile-menu-css');

        //MAIN
        wp_register_style('main-style', get_template_directory_uri() . '/css/frontend/main-style.css', array(), '1.0', 'all');
        wp_enqueue_style('main-style');

        // SILDER           
        wp_register_style('camera-style', get_template_directory_uri() . '/css/silder/camera.css', array(), '1.0', 'all');
        wp_enqueue_style('camera-style');

        // MULTI SILDER
        wp_register_style('flexisel-style', get_template_directory_uri() . '/js/silder-multi/flexisel.css', array(), '1.0', 'all');
        wp_enqueue_style('flexisel-style');

        wp_register_script('flexisel-js', get_template_directory_uri() . '/js/silder-multi/jquery.flexisel.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('flexisel-js');

        //SKITTER
        wp_register_style('skitter-style', get_template_directory_uri() . '/js/skitter-master/skitter.css', array(), 'all'); 
        wp_enqueue_style('skitter-style');

        wp_register_script('skitter-js', get_template_directory_uri() . '/js/skitter-master/jquery.skitter.min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('skitter-js');

        //OWL CAROUSEL
        wp_register_style('owl-carousel-basic-style', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.css', array(), 'all'); 
        wp_enqueue_style('owl-carousel-basic-style');

        wp_register_style('owl-carousel-default-style', get_template_directory_uri() . '/js/owl-carousel/owl.theme.css', array(), 'all'); 
        wp_enqueue_style('owl-carousel-default-style');

        wp_register_script('owl-carousel-js', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('owl-carousel-js');

    } else {

        //====PHAN ADMIN=========================================================
        wp_register_style('admin-style', get_template_directory_uri() . '/css/admin/admin-style.css', array(), '1.0', 'all');
        wp_enqueue_style('admin-style');


        if (get_current_user_id() != 1) {
            wp_register_style('admin-denied', get_template_directory_uri() . '/css/admin/admin-denied.css', array(), '1.0', 'all');
            wp_enqueue_style('admin-denied');
        }
    }


    // ==ADD CHO CA ADMIN VA CLIENT=========================================================
    wp_register_script('check-input', get_template_directory_uri() . '/js/check-input.js', array('jquery'), '1.0.0'); // Custom scripts
    wp_enqueue_script('check-input');

    wp_register_script('jquery-ui-js', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery'), '1.0.0'); // Custom scripts
    wp_enqueue_script('jquery-ui-js');

    wp_register_style('jquery-ui-css', get_template_directory_uri() . '/css/jquery-ui.min.css', array(), '1.0', 'all');
    wp_enqueue_style('jquery-ui-css');

    wp_register_script('superfish-js', get_template_directory_uri() . '/js/menu/superfish.js', array('jquery'), '1.0.0'); // Custom scripts
    wp_enqueue_script('superfish-js');

    wp_register_style('superfish-css', get_template_directory_uri() . '/js/menu/superfish.css', array(), '1.0', 'all');
    wp_enqueue_style('superfish-css');
}

add_action('init', 'style_header_scripts');

function style_footer_scripts()
{

    wp_register_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0.0'); // Custom scripts
    wp_enqueue_script('bootstrap-js');

    wp_register_script('my-script', get_template_directory_uri() . '/js/my-script.js', array('jquery'), '1.0.0'); // Custom scripts
    wp_enqueue_script('my-script');

  

    // SILDER
    wp_register_script('camera-js', get_template_directory_uri() . '/js/silder/camera.min.js', array('jquery'), '1.0.0'); // Custom scripts
    wp_enqueue_script('camera-js');
    wp_register_script('easing-js', get_template_directory_uri() . '/js/silder/jquery.easing.1.3.js', array('jquery'), '1.0.0'); // Custom scripts
    wp_enqueue_script('easing-js');
    wp_register_script('mobile.customized-js', get_template_directory_uri() . '/js/silder/jquery.mobile.customized.min.js', array('jquery'), '1.0.0'); // Custom scripts
    wp_enqueue_script('mobile.customized-js');
}

add_action('wp_footer', 'style_footer_scripts');
