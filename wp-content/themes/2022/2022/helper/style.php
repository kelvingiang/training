<?php

function style_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        //==== PHAN CLIENT================================================================ 
        wp_register_style('main-style', THEME_PART . '/style/css/main.css', 'all');
        wp_enqueue_style('main-style');

        wp_register_style('awesome-style', THEME_PART . '/style/font-awesome.min.css', 'all');
        wp_enqueue_style('awesome-style');


        //=======================================================================================

        wp_register_style('main-style', THEME_PART . '/style.css', 'all');
        wp_enqueue_style('main-style');

        wp_register_style('superfish-style', THEME_PART . '/style/superfish.css', 'all');
        wp_enqueue_style('superfish-style');

        // wp_register_style('flexisel-style', THEME_PART . '/style/flexisel-style.css', 'all');
        // wp_enqueue_style('flexisel-style');

 

        /*     moi them cho 29/04  */
        wp_register_style('fancybox-style', THEME_PART . '/style/fancybox.css', 'all');
        wp_enqueue_style('fancybox-style');

        /* phan chen js */

        wp_register_script('jquery-script', THEME_PART . '/js/jquery-2.1.1.min.js', array('jquery'));
        wp_enqueue_script('jquery-script');

        wp_register_script('superfish-script', THEME_PART . '/js/superfish.js', array('jquery'));
        wp_enqueue_script('superfish-script');

        wp_register_script('custom-script', THEME_PART . '/js/custom.js', array('jquery'));
        wp_enqueue_script('custom-script');

        wp_register_script('ajax-script', THEME_PART . '/js/checkajax.js', array('jquery'));
        wp_enqueue_script('ajax-script');



       /* srtye cua silder */
        wp_register_style('skitter-styles', THEME_PART . '/style/skitter.styles.css', 'all');
        wp_enqueue_style('skitter-styles');
        
        wp_register_style('owl-css', THEME_PART  . '/js/slider-owl/css/owl.carousel.css', array(), '1.0', 'all');
        wp_enqueue_style('owl-css');

        wp_register_style('owl.theme.default-css', THEME_PART  . '/js/slider-owl/css/owl.theme.default.css', array(), '1.0', 'all');
        wp_enqueue_style('owl.theme.default-css');

        wp_register_script('owl.carousel-js', THEME_PART  . '/js/slider-owl/owl.carousel.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('owl.carousel-js');

//===============================
        wp_register_script('ckeditor-script', THEME_PART . '/class/ckeditor/ckeditor.js', array('jquery'));
        wp_enqueue_script('ckeditor-script');

        wp_register_script('ckfinder-script', THEME_PART . '/class/ckfinder/ckfinder.js', array('jquery'));
        wp_enqueue_script('ckfinder-script');

        wp_register_script('jquery-animate', THEME_PART . '/js/jquery.animate-colors-min.js', array('jquery'));
        wp_enqueue_script('jquery-animate');

        wp_register_script('jquery-skitter', THEME_PART . '/js/jquery.skitter.js', array('jquery'));
        wp_enqueue_script('jquery-skitter');

        wp_register_script('jquery-easing', THEME_PART . '/js/jquery.easing.1.3.js', array('jquery'));
        wp_enqueue_script('jquery-easing');

        wp_register_script('jquery-flexisel', THEME_PART . '/js/jquery.flexisel.js', array('jquery'));
        wp_enqueue_script('jquery-flexisel');

        wp_register_script('jquery-jcarousellite', THEME_PART . '/js/jquery.jcarousellite-1.0.1.js', array('jquery'));
        wp_enqueue_script('jquery-jcarousellite');

        //    moi them cho 29/04 
        wp_register_script('jquery-fancybox', THEME_PART . '/js/jquery.fancybox.pack.js', array('jquery'));
        wp_enqueue_script('jquery-fancybox');

        wp_register_script('jquery-mCustomScrollbar', THEME_PART . '/js/jquery.mCustomScrollbar.js', array('jquery'));
        wp_enqueue_script('jquery-mCustomScrollbar');

        /// add boottrap style ===================================================
        wp_register_style('bootstrap', THEME_PART . '/style/bootstrap/bootstrap.min.css', 'all');
        wp_enqueue_style('bootstrap');

        wp_register_style('bootstrap-grid', THEME_PART . '/style/bootstrap/bootstrap-grid.min.css', 'all');
        wp_enqueue_style('bootstrap-grid');

        wp_register_style('bootstrap-reboot', THEME_PART . '/style/bootstrap/bootstrap-reboot.min.css', 'all');
        wp_enqueue_style('bootstrap-reboot');

        // add bootstrap js =====================================================================
        wp_register_script('bootstrap-script', THEME_PART . '/js/bootstrap/bootstrap.min.js', array('jquery'));
        wp_enqueue_script('bootstrap-script');

        // wp_register_script('bootstrap-script-esm', THEME_PART . '/js/bootstrap/bootstrap.esm.min.js', array('jquery'));
        // wp_enqueue_script('bootstrap-script-esm');

        wp_register_script('bootstrap-script-bundle', THEME_PART . '/js/bootstrap/bootstrap.bundle.min.js', array('jquery'));
        wp_enqueue_script('bootstrap-script-bundle');

        //end ======================================================================================
        // wp_register_script('jquery-autohidingnavbar', THEME_PART . '/js/jquery.bootstrap-autohidingnavbar.js', array('jquery'));
        // wp_enqueue_script('jquery-autohidingnavbar');

        wp_register_style('bootstrap-utilities', THEME_PART . '/style/bootstrap/bootstrap-utilities.min.css', 'all');
        wp_enqueue_style('bootstrap-utilities');
    } else {
        //====PHAN ADMIN=========================================================
        wp_register_style('admin-style', THEME_PART . '/style/admin/admin.css', FALSE, '1.0.0');
        wp_enqueue_style('admin-style');

        wp_register_script('custom-script', THEME_PART . '/js/admin/custom.js', array('jquery'));
        wp_enqueue_script('custom-script');
    }
    // ==ADD CHO CA ADMIN VA CLIENT=========================================================

    /// end ===================================================


    wp_register_style('jquery-ui-css', THEME_PART . '/style/jquery-ui.min.css', 'all');
    wp_enqueue_style('jquery-ui-css');

    wp_register_script('jquery-ui-js', THEME_PART . '/js/jquery-ui.min.js', array('jquery'));
    wp_enqueue_script('jquery-ui-js');
}

add_action('init', 'style_header_scripts');
