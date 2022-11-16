<?php

class Admin_Controller_Event
{

    public function __construct()
    {
        add_action('init', array($this, 'Create'));
        add_action('manage_edit-event_columns', array($this, 'ManageColumns'));
        add_action('manage_event_posts_custom_column', array($this, 'RenderColumns'));
    }

    public function Create()
    {
        $labels = array(
            'name' => __('Association Activity'),
            'singular_name' => __('Association Activity'),
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
            'menu_name' => __('Association Activity')
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
            'supports' => array('title', 'thumbnail', 'editor'),
        );
        register_post_type('event', $args);
        flush_rewrite_rules(); // chuyen den trang single cua custom post
    }

    public function ManageColumns($columns)
    {
        unset($columns['home']);
        unset($columns['order']);
        unset($columns['language']);
        unset($columns['postdate']);
        unset($columns['category']);

        $columns['cate'] = __('Category');
        $columns['language'] = __('Language');
        $columns['home'] = __('Home');
        $columns['postdate'] = __('Date');

        return $columns;
    }

    public function RenderColumns($columns)
    {
        global $post;
        switch ($columns) {

            case 'cate':
                $terms = wp_get_post_terms($post->ID, 'event_category');
                if (count($terms) > 0) {
                    foreach ($terms as $key => $term) {
                        echo '<a href=' . custom_redirect($term->slug) . '&' . $term->taxonomy . '=' . $term->slug . '>' . $term->name . '</a></br>';
                    }
                }
                break;

            case 'home':
                $status = get_post_meta($post->ID, '_admin_metabox_special', true);

                if ($status == 'on') {
                    $class = 'active_style';
                } else {
                    $class = 'inactive_style';
                }
                echo "<div class='" . $class . "'></div>";
                break;

            default:
                break;
        }
    }
}
