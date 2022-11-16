<?php

class Admin_Controller_Slider
{

    public function __construct()
    {
        add_action('init', array($this, 'create'));
        add_action('manage_edit-slide_columns', array($this, 'ManageColumns'));
        add_action('manage_slide_posts_custom_column', array($this, 'RenderColumns'));

        add_action('init', array($this, 'CreateTaxonomies'));
    }

    function create()
    {
        $labels = array(
            'name' => __('Slider') . '1000 x 400',
            'singular_name' => __('Slider'),
            'add_new' => __('Add'),
            'add_new_item' => __('Add'),
            'edit_item' => __('Edit'),
            'new_item' => __('Add'),
            'all_items' => __('All'),
            'view_item' => __('View'),
            'search_items' => __('Search'),
            'not_found' => __('Could not find any information'),
            'not_found_in_trash' => __('Recycle bin is empty'),
            'parent_item_colon' => '',
            'menu_name' => __('Slider')
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
            'menu_position' => 6,
            'supports' => array('title', 'thumbnail')
        );
        register_post_type('slide', $args);
    }

    public function ManageColumns($columns)
    {
        unset($columns['date']);
        unset($columns['home']);
        unset($columns['order']);
        unset($columns['language']);
        unset($columns['postdate']);

        $columns['img'] = __('Image');
        $columns['order'] = __('Order');
        $columns['category'] = __('Category');
        $columns['postdate'] = __('Date');

        return $columns;
    }

    public function RenderColumns($columns)
    {
        if ($columns == 'img') {
            if (has_post_thumbnail()) {
                set_post_thumbnail_size(100, 150);
                the_post_thumbnail();
            }
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


    public function CreateTaxonomies()
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
        register_taxonomy('slide_category', 'slide', array(
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
