<?php

class Admin_Controller_Branch
{

    public function __construct()
    {
        add_action('init', array($this, 'create'));
        add_action('manage_edit-brach_columns', array($this, 'ManageColumns'));
        add_action('manage_brach_posts_custom_column', array($this, 'RenderColumns'));
    }

    public function create()
    {
        $labels = array(
            'name' => __('Branch'),
            'singular_name' => __('Branch'),
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
            'menu_name' => __('Branch')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 2,
            /*  'capabilities' => array(
              //       'create_posts' => 'do_not_allow'), */
            'supports' => array('title', 'editor', 'thumbnail'),
        );
        register_post_type('brach', $args);
        //flush_rewrite_rules();
    }

    public function ManageColumns($columns)
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'Title' => __('Branch'),
            'contact' => __('President'),
            'email' => __('E-mail'),
            'phone' => __('Phone'),
            'order_by' => __('Order'),
            'date' => __('Date'),
        );
        return $columns;
    }

    public function RenderColumns($columns)
    {
        global $post;
        switch ($columns) {
                /* If displaying the 'duration' column. */
            case 'email':
                echo get_post_meta($post->ID, 'b_email', true);
                break;
            case 'contact':
                echo get_post_meta($post->ID, 'b_contact', true);
                break;
            case 'phone':
                echo get_post_meta($post->ID, 'b_phone', true);
                break;
            case 'order_by':
                echo get_post_meta($post->ID, '_metabox_order_by', true);
                break;
                /* Just break out of the switch statement for everything else. */
            default:
                break;
        }
    }
}
