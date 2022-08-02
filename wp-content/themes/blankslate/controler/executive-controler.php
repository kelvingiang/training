<?php

class Executive_Controler {

    public function __construct() {
        add_action('init', array($this, 'register_custom_post'));
        add_action('manage_edit-executive_columns', array($this, 'manage_columns'));
        add_action('manage_executive_posts_custom_column', array($this, 'render_columns'));

        add_filter('manage_edit-executive_sortable_columns', array($this, 'sortable_views_column'));
        add_filter('request', array($this, 'sort_views_column'));

        add_action('admin_print_styles-edit.php', array($this, 'board_styles'));
    }

    public function register_custom_post() {
        $labels = array(
            'name' => __('Executive', 'dp'),
            'singular_name' => __('Executive', 'dp'),
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
            'menu_name' => __('Executive', 'dp')
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
            'menu_position' => 4,
            'supports' => array('title', 'thumbnail'),
        );
        register_post_type('executive', $args);
    }

//==== QUAN LY COT HIEN THI TRON BANG   
    public function manage_columns($columns) {
        $date_label = __('Create Date', 'suite');
        unset($columns['date']); // an cot ngay mac dinh
        unset($columns['modified']); // an cot ngay mac dinh
        unset($columns['postdate']); // an cot ngay mac dinh
//==== THEM COT VA BAN
        $columns['image'] = __('Image', 'suite');
        $columns['job-title'] = __('Job Title', 'suite');
        $columns['current'] = __('current' ,'sutie');
        $columns['setorder'] = __('Show Order', 'suite');
        $columns['date'] = $date_label;
        return $columns;
    }

//==== HIEN THI NOI DUNG TRONG COT
    public function render_columns($columns) {
        global $post;
        if ($columns == 'image') {
            echo '<a href="' . get_admin_url() . 'post.php?post=' . $post->ID . '&action=edit">';
            if (has_post_thumbnail()) {
                the_post_thumbnail('post-thumbnail', array('style' => 'width: 80px; height: 50px'));
            } else {
                echo '<img width="300" height="314" style="width: 80px; height: 50px" class="attachment-post-thumbnail wp-post-image" src="' . get_image('no-image.jpg') . '">';
            }
            echo '</a>';
        }

        if ($columns == 'setorder') {
            echo get_post_meta($post->ID, '_metabox_order', true);
        }
        
        if($columns == 'current'){
          $img = get_post_meta($post->ID, '_metabox_current', true) == '1' ? "active32x32.png" : '';
          if(!empty($img)){
           echo '<img  style="width: 32px; height: 32px" class="attachment-post-thumbnail wp-post-image" src="' . get_image('/icon/'.$img) . '">';
          }
        }

        if ($columns == 'job-title') {
            echo '<a href="' . get_admin_url() . 'post.php?post=' . $post->ID . '&action=edit">';
            echo get_post_meta($post->ID, '_metabox_job_title', true);
            echo '</a>';
        }
    }

//====== SAP SEP THEO TRINH TU
    public function sortable_views_column($newcolumn) {
        $newcolumn['setorder'] = 'setorder';
        $newcolumn['current']= 'current';
        return $newcolumn;
    }

    public function sort_views_column($vars) {
        if (isset($vars['orderby']) && 'setorder' == $vars['orderby'] || 'current' == $vars['orderby']) {
            $vars = array_merge($vars, array(
                'meta_key' => '_metabox_order', //Custom field key
                'orderby' => '_metabox_order', //Custom field value (number)
                    ), array(
                   'meta_key' => '_metabox_current', //Custom field key
                   'orderby' => '_metabox_current', //Custom field value (number)                

                    )
            );
            
        };
        return $vars;
    }

    //==== STYLE CHO COLUMNS    
    public function board_styles() {
        ?>
        <style type="text/css"> 
            .column-website{
                width: 20%;
            }
            .column-image{
                width: 100px;
            }
            .column-title{
                width: 30%
            }

        </style>
        <?php

    }

}
