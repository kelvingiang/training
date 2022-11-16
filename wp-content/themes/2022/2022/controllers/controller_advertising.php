<?php

class Admin_Controller_Advertising
{

    public function __construct()
    {
        add_action('init', array($this, 'create'));
        add_action('manage_edit-advertising_columns', array($this, 'ManageColumns'));
        add_action('manage_advertising_posts_custom_column', array($this, 'RenderColumns'));
    }

    public function create()
    {
        $labels = array(
            'name' => __('Advertising'),
            'singular_name' => __('Advertising'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New'),
            'edit_item' => __('Edit'),
            'new_item' => __('Add New'),
            'all_items' => __('All'),
            'view_item' => __('View'),
            'search_items' => __('Search'),
            'not_found' => __('Could not find any information'),
            'not_found_in_trash' => __('Recycle bin is empty'),
            'parent_item_colon' => '',
            'menu_name' => __('Advertising')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_icon' => PART_ICON . 'ad16x16.png',
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 12,
            'supports' => array('title', 'thumbnail', 'editor'),
        );
        register_post_type('advertising', $args);
    }

    // tao function thay doi hien thi mac dinh
    public function ManageColumns($columns)
    {

        unset($columns['home']);
        unset($columns['language']);
        unset($columns['postdate']);
        unset($columns['category']);
        unset($columns['date']);
        unset($columns['order']);
        unset($columns['author']);
        // an cot ngay mac dinh
        // them cot vao bang 
        $columns['title']; // cho an cot title mac dinh;
        $columns['logo_image'] = __('Image');
        $columns['order'] = __('Order');
        $columns['email_col'] = __('Web site');
        $columns['postdate'] = __('Date');


        return $columns;
    }

    // function dua noi dung vao cac cot moi  tạo
    public function RenderColumns($columns)
    {
        global $post;
        if ($columns == 'logo_image') {
            if (has_post_thumbnail()) {
                the_post_thumbnail(array(80, 80));  // Other resolutions);
                //  set_post_thumbnail_size(50, 50); // 50 pixels wide by 50 pixels tall, resize mode
            }
        }

        if ($columns == 'email_col') {
            echo get_post_meta($post->ID, '_tw_metabox_email', TRUE);
        }
        //show product thumb
        //    $img = get_post_meta($post->ID, 'm_image', true);
        //    if ($columns == 'member_image') {
        //        echo '<img  style="width:30px; height: 30px; border-radius: 3px; border: 1px #999 solid" class="attachment-post-thumbnail wp-post-image" src="' . PART_IMAGES_AVATAR . $img . '">';
        //    }
    }
}
