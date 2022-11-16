<?php

class Admin_Controller_Recruitment
{

    public function __construct()
    {
        add_action('init', array($this, 'Create'));
        add_action('manage_edit-recruitment_columns', array($this, 'ManageColumns'));
        add_action('manage_recruitment_posts_custom_column', array($this, 'RenderColumns'));

        add_action('init', array($this, 'CreateTaxonomies'));
    }

    public function Create()
    {
        $labels = array(
            'name' => __('Recruitment'),
            'singular_name' => __('Recruitment'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New'),
            'new_item' => __('Add New'),
            'edit_item' => __('Edit'),
            'all_items' => __('All'),
            'view_item' => __('View'),
            'search_items' => __('Search'),
            'not_found' => __('Could not find any information'),
            'not_found_in_trash' => __('Recycle bin is empty'),
            'parent_item_colon' => '',
            'menu_name' => __('Recruitment'),
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
            'map_meta_cap' => true,
            //     'capabilities' => array(
            //       'create_posts' => 'do_not_allow'), // KHONG CHO PHEP TAO POST MOI, AN CAI ADD NEW POST DI .
            'menu_position' => 7,
            'supports' => array('thumbnail', 'title', 'author')
        );
        register_post_type('recruitment', $args);
    }

    public function ManageColumns($columns)
    {

        unset($columns['date']); /* an cot ngay mac dinh */
        unset($columns['author']);
        unset($columns['ID']);
        unset($columns['language']);

        $columns['postdate'] = __('Date');
        return $columns;
    }

    public function RenderColumns($columns)
    {
        global $post;
        $group = get_post_meta($post->ID, 'r_birthday', true);

        if ($columns == 'recruit_postby') {
            $strPostby = get_post_meta($post->ID, 'r_postby', true);
            echo $strPostby === '' ? 'Admin' : $strPostby;
        }

        if ($columns == 'recruit_category') {
            $terms = wp_get_post_terms($post->ID, 'recruitment_category');
            if (count($terms) > 0) {
                $parent = array();
                foreach ($terms as $key => $term) {
                    if ($term->parent == 0) {
                        $parent[] = $term;
                        unset($terms[$key]);
                    }
                }

                foreach ($parent as $key => &$item) {
                    foreach ($terms as $i => $term) {
                        if ($term->parent == $item->term_id) {
                            $item->childs[] = $term;
                        }
                    }
                }

                $arrShowCat = array();
                foreach ($parent as $p => $val) {
                    $strShowCat = $val->name;
                    $strShowSlug = $val->slug;
                    $strShowTaxonomy = $val->taxonomy;

                    if (count($val->childs) > 0) {
                        foreach ($val->childs as $child) {
                            $strShowCat = $strShowCat . '/' . $child->name;
                            //   $arrShowCat[] = $strShowCat;
                            $arrShowCat[] = array('cat' => $strShowCat, 'slug' => $child->slug, 'taxonomy' => $strShowTaxonomy);
                            // $strShowCat = $val->name;
                        }
                    } else {
                        // $arrShowCat[] = $strShowCat;
                        $arrShowCat[] = array('cat' => $strShowCat, 'slug' => $strShowSlug, 'taxonomy' => $strShowTaxonomy);
                    }
                }

                foreach ($arrShowCat as $cat) {
                    // echo $cat . '<br>';
                    echo '<a href=' . custom_redirect($cat['slug']) . '&' . $cat['taxonomy'] . '=' . $cat['slug'] . '>' . $cat['cat'] . '</a></br>';
                }
            }
        }

        if ($columns == 'recruit_status') {
            $status = get_post_meta($post->ID, '_recruit_status', true);

            if ($status == 'on') {
                $class = 'num num-active';
            } else {
                $class = 'num num-inactive';
            }
            echo '<span class="' . $class . '"></span>';
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
        register_taxonomy('recruitment_category', 'recruitment', array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'taxonomy' => 'category',
            'rewrite' => array(
                'slug' => 'recruitment-category',
                'hierarchical' => true,
            )
        ));
    }
}
