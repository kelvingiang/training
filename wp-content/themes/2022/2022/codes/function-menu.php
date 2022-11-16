<?php


/* them menu co phan khai bao thay doi ngon ngu o phan __  thong qua textdomain */
register_nav_menu('company-menu-cn', __('Company Menu Chinese')); // goi menu de show
register_nav_menu('company-menu-en', __('Company Menu English')); // goi menu de show
register_nav_menu('company-menu-vn', __('Company Menu Vietnamese')); // goi menu de show
register_nav_menu('mobile-menu-cn', __('Mobile Menu Chinese ')); // goi menu de show
register_nav_menu('mobile-menu-en', __('Mobile Menu English')); // goi menu de show
register_nav_menu('mobile-menu-vn', __('Mobile Menu Vietnamese')); // goi menu de show





function suite_menu($slug)
{
    $menu = array(
        'theme_location' => $slug, // chon menu dc thiet lap truoc
        'container' => 'nav', // tap html chua menu nay
        'container_class' => 'primary-menu', // class cua mennu
        'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>'
    );

    wp_nav_menu($menu);
}


// if (!function_exists('mobile_menu')) {

function mobile_menu($slug)
{
    $menu = array(
        'theme_location' => $slug, // chon menu dc thiet lap truoc
        'container' => 'nav', // tap html chua menu nay
        'container_class' => $slug, // class cua mennu
        'container_id' => 'nav-mobile-menu', // class cua mennu
        'items_wrap' => '<ul id="%1$s" class="%2$s sf-mobile-menu">%3$s</ul>'
    );
    wp_nav_menu($menu);
}
//}
