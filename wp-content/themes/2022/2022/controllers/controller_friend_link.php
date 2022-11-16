<?php

class Admin_Controller_Friend_Link
{

    public function __construct()
    {
        add_action('init', array($this, 'Create'));
        add_action('manage_edit-friend_columns', array($this, 'ManageColumns'));
        add_action('manage_friend_posts_custom_column', array($this, 'RenderColumns'));
    }

    public function Create()
    {
        $labels = array(
            'name' => __('Friend Link'),
            'singular_name' => __('Friend Link'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New'),
            'new_item' => __('Add New'),
            'edit_item' => __('Edit'),
            'all_items' => __('All'),
            'view_item' => __('View'),
            'search_items' => __('Search'),
            'not_found' => __('Could not find any information'),
            'not_found_in_trash' => __('Recycle bin is empty'),
            'parent_item_colon' => '',
            'menu_name' => __('Friend Link'),
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
            'menu_position' => 4,
            'supports' => array('title')
        );
        register_post_type('friend', $args);
    }

    public function ManageColumns($columns)
    {
        unset($columns['date']);
        unset($columns['language']);
        unset($columns['postdate']);
        // them cot vao bang
        // $columns['name'] = $name_label;
        $columns['website'] = __('Web Site');
        $columns['order'] = __('Order');
        $columns['postdate'] = __('Date');

        return $columns;
    }

    public function RenderColumns($columns)
    {
        global $post;

        if ($columns == 'name') {
            $strFriendName = get_post_meta($post->ID, 'p_name', true);
            echo '<a href="' . get_admin_url() . 'post.php?post=' . $post->ID . '&action=edit">';
            echo $strFriendName;
            echo '</a>';
        }

        if ($columns == 'website') {
            $strFriendWeb = get_post_meta($post->ID, 'p_web', true);
            echo '<a href="' . get_admin_url() . 'post.php?post=' . $post->ID . '&action=edit">';
            echo $strFriendWeb;
            echo '</a>';
        }

        if ($columns == 'order') {
            echo get_post_meta($post->ID, '_metabox_order_by', true);
        }
    }
}
