<?php

class Admin_controller_Member
{

    public function __construct()
    {
        add_action('init', array($this, 'Create'));
        add_action('manage_edit-member_columns', array($this, 'ManageColumns'));
        add_action('manage_member_posts_custom_column', array($this, 'RenderColumns'));

        add_filter('manage_edit-member_sortable_columns', array($this, 'SortColumn'));
        add_filter('request', array($this, 'sort_views_column'));
    }

    public function Create()
    {
        $labels = array(
            'name' => __('Member'),
            'singular_name' => __('Member'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New'),
            'new_item' => __('Add New'),
            'edit_item' => __('Edit'),
            'all_items' => __('All'),
            'view_item' => __('View'),
            'search_items' => __('Search'),
            'not_found' => __('Could not find any information'),
            'not_found_in_trash' => __('Recycle bin is empty.'),
            'parent_item_colon' => '',
            'menu_name' => __('Member'),
        );
        /*  'capabilities' => array(
          'create_posts' => 'do_not_allow'),  // KHONG CHO PHEP TAO POST MOI
          'map_meta_cap' => true,
         */

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
            'map_meta_cap' => true,
            /*       'capabilities' => array(
              //        'create_posts' => 'do_not_allow'), // KHONG CHO PHEP TAO POST MOI, AN CAI ADD NEW POST DI . */
            'menu_position' => 6,
            'supports' => array('thumbnail')
        );
        register_post_type('Member', $args);
    }

    public function ManageColumns($columns)
    {
        unset($columns['title']); /* cho an cot title mac dinh; */
        unset($columns['date']); /* an cot ngay mac dinh */
        unset($columns['author']);
        unset($columns['language']);
        unset($columns['order']);
        unset($columns['postdate']);
        /*  them cot vao bang  */
        // $columns['member_user'] = __('Account');
        //  $columns['member_image'] = __('Image');
        $columns['title'] = __('Account');
        $columns['member_full_name'] = __('Full Name');
        $columns['member_country'] = __('Branch');
        $columns['member_style'] = __('Types of');
        $columns['member_email'] = __('E-mail');
        //  $columns['member_phone'] = __('Cell Phone');
        $columns['member_status'] = __('Status');

        $columns['postdate'] = __('Date');

        return $columns;
    }

    public function RenderColumns($columns)
    {
        global $post;
        $img = get_post_meta($post->ID, 'm_image', true);
        if ($columns == 'member_image') {
            echo '<img  style="width:30px; height: 30px; border-radius: 3px; border: 1px #999 solid" class="attachment-post-thumbnail wp-post-image" src="' . PART_IMAGES_AVATAR . $img . '">';
        }

        if ($columns == 'member_style') {

            if (get_post_meta($post->ID, 'm_member', true) == "recruit") {
                $member = "招募";
            } elseif (get_post_meta($post->ID, 'm_member', true) == 'apply') {
                $member = "應徵";
            }
            echo   $member;
        }

        if ($columns == 'member_user') {
            $strMemberUser = get_post_meta($post->ID, 'm_user', true);

            echo '<a href="' . get_admin_url() . 'post.php?post=' . $post->ID . '&action=edit">';
            echo $strMemberUser;
            echo '</a>';
        }

        if ($columns == 'member_country') {
            require_once DIR_CODES . 'my-list.php';
            $myList = new Codes_My_List();
            echo '<a href=" ' . admin_url('/edit.php?post_type=member&s=' . get_post_meta($post->ID, 'm_country', true)) . ' ">' . $myList->get_country(get_post_meta($post->ID, 'm_country', true)) . '</a>';
        }

        if ($columns == 'member_full_name') {
            echo get_post_meta($post->ID, 'm_fullname', true);
        }

        if ($columns == 'member_email') {
            echo get_post_meta($post->ID, 'm_email', true);
        }

        if ($columns == 'member_phone') {
            echo get_post_meta($post->ID, 'm_phone', true);
        }

        if ($columns == 'member_status') {
            $status = get_post_meta($post->ID, 'm_active', true);

            if ($status == 'on') {
                $class = 'active_style';
            } else {
                $class = 'inactive_style';
            }
            echo '<div class="' . $class . '"></div>';
        }
    }

    public function SortColumn($column)
    {
        $column['member_country'] = 'setorder';
        $column['member_status'] = 'status';
        return $column;
    }

    public function sort_views_column($vars)
    {
        if (isset($vars['orderby']) && 'setorder' == $vars['orderby']) {
            $vars = array_merge($vars, array(
                'meta_key' => 'm_country',
                'orderby' => 'm_country',
            ));
        } elseif (isset($vars['orderby']) && 'status' == $vars['orderby']) {
            $vars = array_merge($vars, array(
                'meta_key' => 'm_active',
                'orderby' => 'm_active',
            ));
        }

        return $vars;
    }
}
