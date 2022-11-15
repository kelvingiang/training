<?php

class Admin_Controller_Slider
{

    public function __construct()
    {
        add_action('init', array($this, 'register_custom_post'));
        add_action('manage_edit-slider_columns', array($this, 'manage_columns'));
        add_action('manage_slider_posts_custom_column', array($this, 'render_columns'));

        add_filter('manage_edit-slider_sortable_columns', array($this, 'sortable_views_column'));
        add_filter('request', array($this, 'sort_views_column'));

        add_action('init', array($this, 'create_taxonomies'));
    }

    public function register_custom_post()
    {
        $labels = array(
            'name' => __('Slider', 'dp'),
            'singular_name' => __('Slider', 'dp'),
            'add_new' => __('Add Item', 'dp'),
            'add_new_item' => __('Add Item', 'dp'),
            'edit_item' => __('Edit', 'dp'),
            'new_item' => __('Add Item', 'dp'),
            'all_items' => __('All Item', 'dp'),
            'view_item' => __('View Item', 'dp'),
            'search_items' => __('Search', 'dp'),
            'not_found' => __('No slides found.', 'dp'),
            'not_found_in_trash' => __('No found in Trash.', 'dp'),
            'parent_item_colon' => '',
            'menu_name' => __('Slider', 'dp') . '944 x 300'
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => TRUE,
            'menu_icon' => PART_ICON . 'link-icon.png',
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 5,
            'supports' => array('title', 'thumbnail'),
        );
        register_post_type('slider', $args);
    }

    //==== QUAN LY COT HIEN THI TRON BANG   
    public function manage_columns($columns)
    {
        //$date_label = __('Create Date', 'suite');
        unset($columns['date']); // an cot ngay mac dinh
        unset($columns['modified']); // an cot ngay mac dinh
        unset($columns['postdate']); // an cot ngay mac dinh
        unset($columns['home']);
        unset($columns['author']);
        //==== THEM COT VA BAN
        $columns['img'] = __('Image', 'suite');
        $columns['category'] = __('Category');
        //$columns['date'] = $date_label;
        return $columns;
    }

    //==== HIEN THI NOI DUNG TRONG COT
    public function render_columns($columns)
    {
        global $post;
        if ($columns == 'img') {
            echo '<a href="' . get_admin_url() . 'post.php?post=' . $post->ID . '&action=edit">';
            if (has_post_thumbnail()) {
                the_post_thumbnail('post-thumbnail', array('style' => 'width: 80px; height: 50px'));
            } else {
                echo '<img width="300" height="314" style="width: 80px; height: 50px" class="attachment-post-thumbnail wp-post-image" src="' . get_image('no-image.jpg') . '">';
            }
            echo '</a>';
        }

        if ($columns == 'category') {
            global $post;
            $terms = wp_get_post_terms($post->ID, 'slide_category');

            if (count($terms) > 0) {
                foreach ($terms as $key => $term) {
                    echo '<a href=' . custom_redirect($term->slug) . '&' . $term->taxonomy . '=' . $term->slug . '>' . $term->name . '</a></br>';
                }
            }
        }
    }

    //====== SAP SEP THEO TRINH TU
    public function sortable_views_column($newcolumn)
    {
        $newcolumn['setorder'] = 'setorder';
        return $newcolumn;
    }

    public function sort_views_column($vars)
    {
        if (isset($vars['orderby']) && 'setorder' == $vars['orderby']) {
            $vars = array_merge(
                $vars,
                array(
                    'meta_key' => '_metabox_order', //Custom field key
                    'orderby' => '_metabox_order' //Custom field value (number)
                )
            );
        };
        return $vars;
    }

    //===== TAO TAXONOMIES
    public function create_taxonomies()
    {
        $labels = array(
            'name' => __('Category'),
            'singular_name' => __('Category'),
            'search_items' => __('Search Categories'),
            'all_items' => __('Category'),
            'parent_item' => __('Parent'),
            'parent_item_colon' => __('Parent'),
            'edit_item' => __('Edit'),
            'update_item' => __('Update'),
            'add_new_item' => __('Add New'),
            'new_item_name' => __('Add New'),
            'menu_name' => __('Category')
        );
        register_taxonomy('slide_category', 'slider', array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'taxonomy' => 'category',
            'rewrite' => array(
                'slug' => 'slide-category',
                'hierarchical' => true,
            )
        ));
    }
}
