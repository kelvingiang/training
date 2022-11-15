<?php 

class Admin_Controller_News {
    public function __construct()
    {
        add_action('init', array($this, 'register_custom_post'));
        add_action('manage_edit-news_columns', array($this, 'manage_columns'));
        add_action('manage_news_posts_custom_column', array($this, 'render_columns'));

        add_filter('manage_edit-news_sortable_columns', array($this, 'sortable_views_column'));
        add_filter('request', array($this, 'sort_views_column'));

        add_action('init', array($this, 'create_taxonomies'));
    }

    public function register_custom_post()
    {
        $labels = array(
            'name' => __('News', 'dp'),
            'singular_name' => __('News', 'dp'),
            'add_new' => __('Add News Item', 'dp'),
            'add_new_item' => __('Add Item', 'dp'),
            'edit_item' => __('Edit', 'dp'),
            'new_item' => __('Add Item', 'dp'),
            'all_items' => __('All News Item', 'dp'),
            'view_item' => __('View Item', 'dp'),
            'search_items' => __('Search', 'dp'),
            'not_found' => __('No news found.', 'dp'),
            'not_found_in_trash' => __('No found in Trash.', 'dp'),
            'parent_item_colon' => '',
            'menu_name' => __('News', 'dp')
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
            'menu_position' => 6,
            'supports' => array('title', 'editor', 'thumbnail'),
        );
        register_post_type('news', $args);
    }

    //==== QUAN LY COT HIEN THI TRON BANG   
    public function manage_columns($columns)
    {
        unset($columns['date']); // an cot ngay mac dinh
        unset($columns['modified']); // an cot ngay mac dinh
        unset($columns['postdate']); // an cot ngay mac dinh
        unset($columns['author']); // an cot mac dinh
        //==== THEM COT VA BAN
        $columns['img'] = __('Image', 'suite');
        $columns['content'] = __('Content', 'suite');
        $columns['category'] = __('Category');
        $columns['email'] = __('Email');
        return $columns;
    }

    //==== HIEN THI NOI DUNG TRONG COT
    public function render_columns($columns)
    {
        global $post;
        if ($columns == 'content') {
            the_content();
        }
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
            $terms = wp_get_post_terms($post->ID, 'news_category');

            if (count($terms) > 0) {
                foreach ($terms as $key => $term) {
                    echo '<a href=' . custom_redirect($term->slug) . '&' . $term->taxonomy . '=' . $term->slug . '>' . $term->name . '</a></br>';
                }
            }
        }

        if ($columns == 'email') {
            echo get_post_meta($post->ID, '_metabox_news_email', true);
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
        }elseif (isset($vars['orderby']) && 'show_at_home' == $vars['orderby']) {
            $vars = array_merge($vars, array(
                'meta_key' => '_metabox_show_at_home',
                'orderby' => '_metabox_show_at_home',
            ));
        }
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
        register_taxonomy('news_category', 'news', array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'taxonomy' => 'category',
            'rewrite' => array(
                'slug' => 'news_category',
                'hierarchical' => true,
            )
        ));
    }
}