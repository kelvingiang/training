<?php

class Admin_Controller_Apply
{

    public function __construct()
    {

        add_action('init', array($this, 'create'));
        add_action('manage_edit-member_columns', array($this, 'ManageColumns'));
        add_action('manage_member_posts_custom_column', array($this, 'RenderColumns'));

        add_action('admin_menu', array($this, 'sub_menu'));
    }

    public function create()
    {
        $labels = array(
            'name' => _x('活動報名設定', 'suite'),
            'singular_name' => _x('活動報名設定', 'suite'),
            'add_new' => _x('', 'suite'),
            'add_new_item' => _x('設定活動報名', 'suite'),
            'edit_item' => _x('修改活動報名設定', 'suite'),
            'new_item' => _x('New Join', 'suite'),
            'all_items' => _x('Join List', 'suite'),
            'view_item' => _x('View Join', 'suite'),
            'search_items' => _x('Search Join', 'suite'),
            'not_found' => _x('No slides found.', 'suite'),
            'not_found_in_trash' => _x('No Forum found in Trash.', 'suite'),
            'parent_item_colon' => '',
            'menu_name' => _x('活動報名設定', 'suite')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => FALSE, /* PHAN KHONG HIEN O MENU ADMIN */
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 100,
            'supports' => array('title'),
        );
        register_post_type('apply', $args);
    }

    public function ManageColumns($columns)
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'Title' => __('標題', 'suite'),
            'date' => __('Date', 'suite'),
        );

        return $columns;
    }

    public function RenderColumns($columns)
    {
        switch ($columns) {
            default:
                break;
        }
    }

    public function sub_menu()
    {
        add_submenu_page('edit.php?post_type=event', _x('活動報名設定', 'suite'), _x('活動報名設定', 'suite'), 'custom_menu_access', 'edit.php?post_type=apply');
    }
}