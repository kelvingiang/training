<?php

class Member_Controller
{

    public function __construct()
    {
        add_action('init', array($this, 'register_custom_post'));
        add_action('manage_edit-member_columns', array($this, 'manage_columns'));
        add_action('manage_member_posts_custom_column', array($this, 'render_columns'));

        add_action('init', array($this, 'create_taxonomies'));

        add_filter('manage_edit-member_sortable_columns', array($this, 'sortable_views_column'));
        add_filter('request', array($this, 'sort_views_column'));
    }

    public function register_custom_post()
    {
        $labels = array(
            'name' => __('Member', 'dp'),
            'singular_name' => __('Member', 'dp'),
            'add_new' => __('Add Member Item', 'dp'), //slide-menu
            'add_new_item' => __('Add Item', 'dp'),
            'edit_item' => __('Edit', 'dp'),
            'new_item' => __('Add Item', 'dp'),
            'all_items' => __('All Member Item', 'dp'), //slide-menu
            'view_item' => __('View Item', 'dp'),
            'search_items' => __('Search', 'dp'),
            'not_found' => __('No members found.', 'dp'),
            'not_found_in_trash' => __('No found in Trash.', 'dp'),
            'parent_item_colon' => '',
            'menu_name' => __('Member', 'dp')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => TRUE,
            'menu_icon' => PART_ICON . 'staff-icon.png',
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 7,
            'supports' => array('title'),
        );
        register_post_type('member', $args);
    }

    //==== QUAN LY COT HIEN THI TRON BANG   
    public function manage_columns($columns)
    {
        //$date_label = __('Create Date', 'suite');
        unset($columns['date']); // an cot ngay mac dinh
        unset($columns['modified']); // an cot ngay mac dinh
        unset($columns['postdate']); // an cot ngay mac dinh
        //==== THEM COT VA BAN
        //$columns['img'] = __('Image', 'suite');
        $columns['setorder'] = __('Show Order', 'suite');
        $columns['member_group'] = __('Member group');  //taxonomy
        $columns['contact'] = __('Contact', 'suite');
        $columns['address'] = __('Address');
        $columns['phone'] = __('Phone');
        $columns['district'] = __('District'); //select
        $columns['black_list'] = __('Black List');  //check
        //$columns['date'] = $date_label;
        return $columns;
    }

    //==== HIEN THI NOI DUNG TRONG COT
    public function render_columns($columns)
    {
        global $post;
        if ($columns == 'setorder') {
            echo get_post_meta($post->ID, '_metabox_order', true);
        }

        if ($columns == 'member_group') {
            global $post;
            $terms = wp_get_post_terms($post->ID, 'member-member_group');

            if (count($terms) > 0) {
                foreach ($terms as $key => $term) {
                    echo '<a href=' . custom_redirect($term->slug) . '&' . $term->taxonomy . '=' . $term->slug . '>' . $term->name . '</a></br>';
                }
            }
        }

        if ($columns == 'contact') {
            echo get_post_meta($post->ID, '_metabox_member_contact', true);
        }

        if ($columns == 'address') {
            echo get_post_meta($post->ID, '_metabox_member_address', true);
        }

        if ($columns == 'phone') {
            echo get_post_meta($post->ID, '_metabox_member_phone', true);
        }

        if ($columns == 'black_list') {
            if (get_post_meta($post->ID, '_metabox_member_black_list', true) == 1) {
                echo '<div class="blacklist"></div>';
            }
        }

        if ($columns == 'district') {
            echo get_post_meta($post->ID, '_metabox-member_district', true);
        }
    }

    //====== SAP SEP THEO TRINH TU
    public function sortable_views_column($newcolumn)
    {
        $newcolumn['setorder'] = 'setorder';
        $newcolumn['black_list'] = 'black_list';
        return $newcolumn;
    }

    public function sort_views_column($vars)
    {
        if (isset($vars['orderby']) && 'setorder' == $vars['orderby']) {
            $vars = array_merge($vars, array(
                'meta_key' => '_metabox_order',
                'orderby' => '_metabox_order',
            ));
        } elseif (isset($vars['orderby']) && 'black_list' == $vars['orderby']) {
            $vars = array_merge($vars, array(
                'meta_key' => '_metabox_member_black_list',
                'orderby' => '_metabox_member_black_list',
            ));
        }
        return $vars;
    }

    //===== TAO TAXONOMIES
    public function create_taxonomies()
    {
        $labels = array(
            'name' => __('Member Group'),
            'singular_name' => __('Member Group'),
            'search_items' => __('Search Member groups'),
            'all_items' => __('Member Group'),
            'parent_item' => __('Parent'),
            'parent_item_colon' => __('Parent'),
            'edit_item' => __('Edit'),
            'update_item' => __('Update'),
            'add_new_item' => __('Add New'),
            'new_item_name' => __('Add New'),
            'menu_name' => __('Member Group')
        );
        register_taxonomy('member-member_group', 'member', array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'taxonomy' => 'member_group',
            'rewrite' => array(
                'slug' => 'member-member_group',
                'hierarchical' => true,
            )
        ));
    }
}
