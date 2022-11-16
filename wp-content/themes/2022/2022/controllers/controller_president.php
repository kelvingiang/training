<?php

class Admin_Controller_President
{

    public function __construct()
    {
        add_action('init', array($this, 'create'));
        add_action('manage_edit-president_columns', array($this, 'ManageColumns'));
        add_action('manage_president_posts_custom_column', array($this, 'RenderColumns'));

        add_filter('manage_edit-president_sortable_columns', array($this, 'SortColumn'));
        add_filter('request', array($this, 'sort_views_column'));
    }

    public function create()
    {
        $labels = array(
            'name' => __('All Branch Past Presidents'),
            'singular_name' => __('All Branch Past Presidents'),
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
            'menu_name' => __('All Branch Past Presidents')
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
            'supports' => array('title', 'thumbnail'),
        );
        register_post_type('president', $args);
    }

    // tao function thay doi hien thi mac dinh
    public function ManageColumns($columns)
    {

        unset($columns['home']);
        unset($columns['order']);
        unset($columns['language']);
        unset($columns['postdate']);
        unset($columns['category']);
        unset($columns['author']);
        //$columns['content'] = __('職稱','suite');
        // them cot vao bang 

        $columns['president_branch'] = __('商會');
        $columns['president_term'] = __('屆期');
        $columns['president_year'] = __('年度');


        return $columns;
    }

    // function dua noi dung vao cac cot moi  tạo
    public function RenderColumns($columns)
    {

        global $post;
        if ($columns == 'president_image') {
            if (has_post_thumbnail()) {
                the_post_thumbnail(array(80, 80));  // Other resolutions);
                //  set_post_thumbnail_size(50, 50); // 50 pixels wide by 50 pixels tall, resize mode
            }
        }
        if ($columns == 'president_branch') {
            require_once DIR_CODES . 'my-list.php';
            $myList = new Codes_My_List();
            echo $myList->get_country(get_post_meta($post->ID, "_president_branch", TRUE));
        }

        if ($columns == 'president_term') {
            echo get_post_meta($post->ID, "_president_term", true);
        }

        if ($columns == 'president_year') {
            echo get_post_meta($post->ID, "_president_year", true);
        }
    }

    public function SortColumn($newcolumn)
    {

        $newcolumn['president_branch'] = 'president_branch';
        return $newcolumn;
    }

    public function sort_views_column($vars)
    {
        //        die('uuuu');
        if (isset($vars['orderby']) && 'president_branch' == $vars['orderby']) {
            $vars = array_merge(
                $vars,
                array(
                    'meta_key' => '_president_branch', //Custom field key
                    'orderby' => '_president_branch' //Custom field value (number)
                )
            );
        }

        return $vars;
    }
}
