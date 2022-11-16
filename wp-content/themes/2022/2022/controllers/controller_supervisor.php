<?php

class Admin_Controller_Supervisor
{

    public function __construct()
    {
        add_action('init', array($this, 'Create'));
        add_action('manage_edit-supervisor_columns', array($this, 'ManageColumns'));
        add_action('manage_supervisor_posts_custom_column', array($this, 'RenderColumns'));
    }

    public function Create()
    {
        $labels = array(
            'name' => __('Supervisor'),
            'singular_name' => __('Supervisor'),
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
            'menu_name' => __('Supervisor')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_icon' => PART_ICON . 'admin16x16.png',
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 11,
            'supports' => array('title', 'thumbnail', 'editor'),
        );
        register_post_type('supervisor', $args);
    }

    // tao function thay doi hien thi mac dinh
    public function ManageColumns($columns)
    {
        // an cot ngay mac dinh
        unset($columns['home']);
        unset($columns['order']);
        unset($columns['language']);
        unset($columns['postdate']);
        unset($columns['category']);
        unset($columns['date']);
        unset($columns['author']);

        // them cot vao bang 
        $columns['title'];
        $columns['name'] = __('Full Name');
        $columns['image'] = __('Image');
        $columns['order'] = __('Order');
        $columns['postdate'] = __('Date');

        return $columns;
    }

    // function dua noi dung vao cac cot moi  tạo
    public function RenderColumns($columns)
    {
        global $post;

        switch ($columns) {
            case 'image':
                if (has_post_thumbnail()) {
                    the_post_thumbnail(array(80, 80));  // Other resolutions);
                    //  set_post_thumbnail_size(50, 50); // 50 pixels wide by 50 pixels tall, resize mode
                }
                break;
                // case 'order':
                //     //  echo get_post_meta($post->ID, '_metabox_order', true);
                //     break;
            case 'name':
                echo get_the_content();
                break;
        }
    }
}
