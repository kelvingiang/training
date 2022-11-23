<?php

//==== GET PARAM TREN URL============================================
function getParams($name = null)
{
    if ($name == null || empty($name)) {
        return $_REQUEST; // TRA VE GIA TRI REQUEST
    } else {
        // TRUONG HOP name DC CHUYEN VAO 
        // KIEM TRA name CO TON TAI TRA VE name NGUOI ''
        $val = (isset($_REQUEST[$name])) ? $_REQUEST[$name] : ' ';
        return $val;
    }
}

//============= KIEM DU LIEU CHUYEN QUA BANG PHUONG POST HAY GET======================
function isPost()
{
    $flag = ($_SERVER['REQUEST_METHOD'] == 'POST') ? TRUE : FALSE;
    return $flag;
}

//=======================  FUNCTION GET HINH ==================================
function get_image($name = '')
{
    return get_template_directory_uri() . '/images/' . $name;
}

//Function duoc goi trong news-controller.php trong phan tao taxonomy
function custom_redirect($location)
{
    global $post_type;
    $location = admin_url('edit.php?post_type=' . $post_type);
    return $location;
}

//========================== FUNCTION ==================================

//function dung de quay tro lai trang truoc do
function goback($num = 1)
{
    $paged = max(1, $arrParams['paged']);
    $url = 'admin.php?page=' . $_REQUEST['page'] . '&paged=' . $paged . '&msg=' . $num;
    wp_redirect($url);
}

//function phan trang bang numeric
function numeric_pagination($paged = 1)
{
    global $wp_query;
    $big = 999999999; //dãy là giá trị số trang lớn nhất ta cho 1 số bất kỳ
    $base = str_replace($big, '%#%', esc_url(get_pagenum_link($big))); // tạo link phân trang
    $format = '?page=%#%'; // kiểu lấy url mặc định, không nên đổi
    $current = max(1, $paged);
    $total = $wp_query->max_num_pages;
    if($total > 1) echo '<div id="paginate" class="slider-multi-paginate">';
    echo paginate_links( array(
        'base' => $base,
        'format' => $format,
        'total' => $total,
        'current' => $current,
        'show_all' => FALSE,
        'end_size' => 1, // số trang đầu và cuối
        'mid_size' => 2, // Số trang hiện tại
        'prev_next' => true,
        // 'prev_text' => __('« Previous'),
        // 'next_text' => __('Next »'),
        'type' => 'plain', // Các kiểu hiện thị HTML ; plain = <a> ; list = <li>; array = trả về kiểu array.
        'add_args' => false, // Add thêm giá trị trên url URL VD : array ('test' => 'abc')
        'add_fragment' => '', // Add thêm fragment vào URL VD : &test = abc
        'before_page_number' => '', // Thêm giá trị trước item phân trang
        'after_page_number' => ''  // Thêm giá trị sau item phân trang
    )); 
    if($total > 1) echo '</div>';
}

//=============================== MENU ==============================
register_nav_menu('main-menu', __('Main Menu'));  
register_nav_menu('menu-mobile', __('Mobile Menu')); 

//function khai bao trong template-header-menu.php
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

//function khai bao trong template-head-menu-mobile.php
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



