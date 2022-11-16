<?php

class Admin_controller_Join
{

    public function __construct()
    {
        add_action('init', array($this, 'create'));
        add_action('manage_edit-member_columns', array($this, 'ManageColumns'));
        add_action('manage_member_posts_custom_column', array($this, 'RenderColumns'));

        add_action('admin_menu', array($this, 'join_sub_menu'));
    }

    public function create()
    {
        $labels = array(
            'name' => _x('參加活動名單', 'suite'),
            'singular_name' => _x('參加活動名單', 'suite'),
            'add_new' => _x('', 'suite'),
            'add_new_item' => _x('Add New Join', 'suite'),
            'edit_item' => _x('查看', 'suite'),
            'new_item' => _x('New Join', 'suite'),
            'all_items' => _x('參加名單', 'suite'),
            'view_item' => _x('View Join', 'suite'),
            'search_items' => _x('Search Join', 'suite'),
            'not_found' => _x('No slides found.', 'suite'),
            'not_found_in_trash' => _x('No Forum found in Trash.', 'suite'),
            'parent_item_colon' => '',
            'menu_name' => _x('參加活動名單', 'suite')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => false, /* PHAN KHONG HIEN O MENU ADMIN */
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 2,
            'supports' => array('thumbnail'),
        );
        register_post_type('join', $args);
        // flush_rewrite_rules(); /* chuyen den trang single cua custom post */
    }

    public function ManageColumns($columns)
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'Title' => __('活動標準', 'suite'),
            'registerby' => __('報名者', 'suite'),
            'brach' => __('商會名稱', 'suite'),
            'count' => __('參加人數', 'suite'),
            'date' => __('日期', 'suite'),
        );
        return $columns;
    }

    public function RenderColumns($columns)
    {
        global $post;
        switch ($columns) {

                /* If displaying the 'duration' column. */
            case 'registerby':
                echo '<p>';
                echo get_post_meta($post->ID, 'e_fullname', true);
                echo '</p>';
                break;

                /* If displaying the 'genre' column. */
            case 'eventtitle':
                echo '<a href="' . get_admin_url() . 'post.php?post=' . $post->ID . '&action=edit">';
                echo get_post_meta($post->ID, 'e_eventtitle', true);
                echo '</a>';
                break;

            case 'brach':
                echo '<p>';
                echo get_post_meta($post->ID, 'e_brach', true);
                echo '</p>';
                break;
            case 'count':
                echo '<p>';
                echo get_post_meta($post->ID, 'e_count', true);
                echo '</p>';
                break;

                /* Just break out of the switch statement for everything else. */
            default:
                break;
        }
    }

    public function join_sub_menu()
    {
        add_submenu_page('edit.php?post_type=event', _x('參加活動名單', 'suite'), _x('參加活動名單', 'suite'), 'custom_menu_access', 'edit.php?post_type=join');
        /* custom_menu_access PHAN QUYEN NAY DC TAO TAI FILE FUNCTION; */
    }
}