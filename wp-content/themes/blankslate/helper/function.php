<?php

/* ===== change language =========================================== */
// global $language;
// $language = 'zh_TW';

// function change_translate_text($translated) {
//     global $language;
//     $file = dirname(dirname(dirname(dirname(__FILE__)))) . "/languages/{$language}/data.php";
//     include_once $file;
//     $data = getTranslate();
//     if (isset($data[$translated])) {
//         return $data[$translated];
//     }
//     return $translated;
// }

// add_filter('gettext', 'change_translate_text', 20);

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

//===========  FUNCTION GET HINH ==============================================
function get_image($name = '')
{
    return get_template_directory_uri() . '/images/' . $name;
}

function get_qrcode_img($barcode = '')
{
    return get_template_directory_uri() . '/images/qrcode/' . $barcode . '.png';
}

function get_guests_img($img = '')
{
    return get_template_directory_uri() . '/images/guests/' . $img;
}

//===============FUNCTION =================
function createRandom($length)
{
    //$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $characters = "0123456789";
    $charsLength = strlen($characters) - 1;
    $string = "";
    for ($i = 0; $i < $length; $i++) {
        $randNum = mt_rand(0, $charsLength);
        $string .= $characters[$randNum];
    }
    return $string;
}

function createQRcode($code)
{


    // $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    require_once(DIR_QRCODE . 'qrlib.php');

    $filepath = DIR_IMAGE_QRCODE . $code . '.png';
    //    $files = glob(rtrim(DIR_IMAGE_QRCODE_NAME . '*.png')); //get all file names
    //foreach ($files as $file) {
    //      unlink($file); //delete file
    // L M Q H
    $errorCorrectionLevel = "L";
    // size 1 - 10
    $matrixPointSize = 3;
    QRcode::png($code, $filepath, $errorCorrectionLevel, $matrixPointSize, 2);

    // DOI TEN FILE THEO KIEU CHU HOA
    // $newName =  iconv('UTF-8','BIG5',WB_DIR_IMAGES_BARCODE.$name.'-'.$filename .'.png');
    // $oldName  =  iconv('UTF-8','BIG5', $filepath);
    // rename($oldName , $newName);     
    // return $filename;
}

function goback($num = 1)
{
    $paged = max(1, $arrParams['paged']);
    $url = 'admin.php?page=' . $_REQUEST['page'] . '&paged=' . $paged . '&msg=' . $num;
    wp_redirect($url);
}

function getMemberIndustry()
{
    global $wpdb;
    $table = $wpdb->prefix . 'member_industry';
    $sql = "SELECT ID, name FROM $table";
    $row = $wpdb->get_results($sql, ARRAY_A);
    return $row;
}

//add_image_size( 'thumb1', 150, 150, true );
//================== CUSTOM COLUMNS ON DEFAULT POST ==========================================
// THEM COT VAO POST MAC DINH  
//$ss = get_current_screen();


add_filter('manage_pages_columns', 'itsg_add_custom_column');
add_filter('manage_posts_columns', 'itsg_add_custom_column');

function itsg_add_custom_column($columns)
{
    $columns['modified'] = __('Prioritize Show');
    $columns['postdate'] = __('Create Date');
    return $columns;
}

// THEM NOI DUNG VAO COT MOI THEM
add_action('manage_pages_custom_column', 'itsg_add_custom_column_data', 10, 2);
add_action('manage_posts_custom_column', 'itsg_add_custom_column_data', 10, 2);

function itsg_add_custom_column_data($column, $post_id)
{
    switch ($column) {
        case 'modified':
            $show = get_post_meta($post_id, '_metabox_prioritize', true);
            if ($show == 1) {
                echo '<div class="active-style"></div>';
            }
            break;
        case 'postdate':
            echo get_the_date();
            break;
    }
}

// =====================AN DI CAC COT MAC DINH TRONG POST====================================
if (!function_exists('wp_remove_wp_columns')) :

    function wp_remove_wp_columns($columns)
    {
        unset($columns['tags']);
        unset($columns['comments']);
        unset($columns['author']);
        unset($columns['date']);
        return $columns;
    }

    function wp_remove_wp_columns_init()
    {
        add_filter('manage_posts_columns', 'wp_remove_wp_columns');
    }

    add_action('admin_init', 'wp_remove_wp_columns_init');
endif;

function add_ourteam_columns($columns)
{
    unset($columns['title']);
    unset($columns['tags']);
    unset($columns['date']);
    return array_merge($columns, array(
        'name' => __('name'),
        'designation' => __('Designation'),
        'image' => __('Image'),
        'date' => __('Date')
    ));
}

add_filter('manage_our-team_posts_columns', 'add_ourteam_columns');

//================= SORT COT THEM VAO===========================
function sortable_id_column($columns)
{
    $columns['modified'] = 'modified';
    return $columns;
}

add_filter('manage_edit-post_sortable_columns', 'sortable_id_column');
//========== SORT THEO GIA TRI metapost
add_action('pre_get_posts', 'my_modified_orderby');

function my_modified_orderby($query)
{
    if (!is_admin())
        return;

    $orderby = $query->get('orderby');

    if ('modified' == $orderby) {
        $query->set('meta_key', '_metabox_prioritize');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'DESC'); // them dong nay sort se ko thay doi ASC hay DESC
    }
}

////====================if (basename($_SERVER["REQUEST_URI"]) == 'checkout' || basename($_SERVER["REQUEST_URI"]) == 'contact') {
require DIR_CLASS . 'captcha/CaptchaCls.php';

$objCaptcha = new CaptchaCls(5, true);
//}



/* =====  TAO MENU SHOW BEN NGOAI ======================================================== */
if (!function_exists('main-menu')) {

    function get_menu($slug)
    {
        $menu = array(
            'theme_location' => $slug, // chon menu dc thiet lap truoc
            'container' => 'nav', // tap html chua menu nay
            'container_class' => $slug, // class cua mennu
            'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu ">%3$s</ul>'
            //            'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu sf-js-enabled sf-arrows">%3$s</ul>'
        );
        wp_nav_menu($menu);
    }
}

register_nav_menu('main-menu', __('Main name', 'suite')); // goi menu de show
register_nav_menu('cell-menu', __('Mobile name', 'suite')); // goi menu de show
//
//
// THAY DOI LOGO DANG NHAP O ADMIN
if (!is_admin()) {

    // custom admin login logo
    function custom_login_logo()
    {
        echo '<style type="text/css">
	h1 a { background-image: url(' . PART_IMAGES . 'logo.png' . ') !important; }
	</style>';
    }

    add_action('login_head', 'custom_login_logo');
}

// FUNCTION SEO 
function seo()
{
    //  global $suite;
    global $suite;
    $suite = array(
        'txtTitleSeo' => get_option('commerce_name'),
        'strDescriptionSeo' => get_option('commerce_name') . '-' . get_option('commerce_address'),
        'strKeywordsSeo' => get_option('commerce_name'),
    );
    if (is_home() == true) {

        // THE DOI GIA TRI CUA TITLE WP_HEAD
        function custom_title()
        {
            global $suite;
            return $suite['txtTitleSeo'];
        }

        add_filter('wp_title', 'custom_title');
        echo '<title>' . $suite['txtTitleSeo'] . '</title>';
        echo '<meta name="description" content="' . $suite['strDescriptionSeo'] . '" />';
        echo '<meta name="keywords" content="' . $suite['strKeywordsSeo'] . '" />';
    } else if (is_single() || is_page()) {

        global $post;
        $strSeoTitle = get_post_meta($post->ID, '_seo_title', true);
        $strSeoDescription = get_post_meta($post->ID, '_seo_description', true);
        $strSeoKeywords = get_post_meta($post->ID, '_seo_key', true);

        global $strTitle;
        if (empty($strSeoTitle) != false) {
            $strTitle = $suite['txtTitleSeo'] . '-' . get_query_var('pagename');
        } else {
            $strTitle = $suite['txtTitleSeo'] . ' - ' . $strSeoTitle;
        }

        // THE DOI GIA TRI CUA TITLE WP_HEAD
        function custom_title()
        {
            global $strTitle;
            return $strTitle;
        }

        add_filter('wp_title', 'custom_title');
        echo '<title>' . $strTitle . '</title>';
        echo '<meta name="description" content="' . $strSeoTitle . $strSeoDescription . get_query_var('pagename') . '" />';
        echo '<meta name="keywords" content="' . get_query_var('pagename') . '-' . $strSeoTitle . '-' . $strSeoDescription . '" />';
    } else if (is_tax() || is_tag() || is_category()) {
        global $taxonomy, $term;
        $term = get_term_by('slug', $term, $taxonomy);
        $term_id = $term->term_id;
        $term_meta = get_option("taxonomy_$term_id");

        $strSeoTitle = $term_meta['txtTitleSeo'];
        $strSeoDescription = $term_meta['strDescriptionSeo'];
        $strSeoKeywords = $term_meta['seo_keywords'];

        if (empty($strSeoTitle) != false) {
            $strTitle = $suite['txtTitleSeo'];
        } else {
            $strTitle = $suite['txtTitleSeo'] . ' - ' . $strSeoTitle;
        }

        // THE DOI GIA TRI CUA TITLE WP_HEAD
        function custom_title()
        {
            global $strTitle;
            return $strTitle;
        }

        add_filter('wp_title', 'custom_title');
        echo '<title>' . $strTitle . '</title>';
        echo '<meta name="description" content="' . $strSeoDescription . '" />';
        echo '<meta name="keywords" content="' . $strSeoKeywords . '" />';
    }
    echo '<meta name="robots" content="INDEX,FOLLOW" />';
    echo '<meta http-equiv="REFRESH" content="1800" />';
}
