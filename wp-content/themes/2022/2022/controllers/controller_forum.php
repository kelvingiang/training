<?php

class Admin_Controller_Forum
{

    public function __construct()
    {
        add_action('init', array($this, 'create'));
        add_action('manage_edit-forum_columns', array($this, 'ManageColumns'));
        add_action('manage_forum_posts_custom_column', array($this, 'RenderColumns'));

        add_action('init', array($this, 'createTaxonomy'));
    }

    public function create()
    {
        $labels = array(
            'name' => __('留言區'),
            'singular_name' => __('留言區'),
            'add_new' => __('新增'),
            'add_new_item' => __('新增'),
            'edit_item' => __('修改'),
            'new_item' => __('新增'),
            'all_items' => __('全部留言'),
            'view_item' => __('顯示'),
            'search_items' => __('搜尋'),
            'not_found' => __('搜不到任何資料'),
            'not_found_in_trash' => __('回收桶是空.'),
            'parent_item_colon' => '',
            'menu_name' => __('留言區')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'forum',
                'cate' => true,
                'with_front' => false,
                'feed' => true,
                'pages' => true
            ),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 2,
            'supports' => array('title', 'thumbnail', 'editor', 'comments', 'author'),
        );
        register_post_type('forum', $args);
        // flush_rewrite_rules(FALSE); /* chuyen den trang single cua custom post */
    }

    public function ManageColumns($columns)
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __('Title'),
            'status' => __('狀態'),
            'comments' => __('迴響'),
            'category' => __('類別'),
            'postby' => __('發布人'),
            'date' => __('發布日期'),
        );
        return $columns;
    }

    public function RenderColumns($columns)
    {
        global $post;
        switch ($columns) {

                /* If displaying the 'duration' column. */
                //     case 'content' :
                //   the_content_rss('', TRUE, '', 50);
                //    break;

                /* If displaying the 'genre' column. */
            case 'status':
                $status = get_post_meta($post->ID, 'f_active', TRUE);

                if ($status == 'on') {
                    $class = 'num num-active';
                } else {
                    $class = 'num num-inactive';
                }
                echo '<span class="' . $class . '"></span>';
                break;

            case 'category':
                $terms = wp_get_post_terms($post->ID, 'forum_category');
                //  $terms = wp_get_post_terms($post->ID, 'pcate');
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
                        $strShowCat = $val->name; // thong tin den hinr thi
                        $strShowSlug = $val->slug;  // thong tin slug de tao link 
                        $strShowTaxonomy = $val->taxonomy; // thong tin taxonomy de lay doi tuong search

                        if (count($val->childs) > 0) {
                            foreach ($val->childs as $child) {
                                $strShowCat = $strShowCat . '/' . $child->name;
                                // neu la lop cho lay slug cua lop con
                                $arrShowCat[] = array('cat' => $strShowCat, 'slug' => $child->slug, 'taxonomy' => $strShowTaxonomy);
                            }
                        } else {
                            $arrShowCat[] = array('cat' => $strShowCat, 'slug' => $strShowSlug, 'taxonomy' => $strShowTaxonomy);
                        }
                    }

                    //  
                    foreach ($arrShowCat as $cat) {

                        //==== TAO LINK CHO CATEGORY DE LAY SEARCH THEO DOI TUONG
                        echo '<a href=' . custom_redirect($cat['slug']) . '&' . $cat['taxonomy'] . '=' . $cat['slug'] . '>' . $cat['cat'] . '</a></br>';
                    }
                    break;
                }

            case 'postby':
                $postby = get_post_meta($post->ID, 'f_postby', TRUE);
                echo '<span>' . $postby . '</span>';
                break;

                /* Just break out of the switch statement for everything else. */
            default:
                break;
        }
    }

    public function createTaxonomy()
    {
        $labels = array(
            'name' => __('分類'),
            'singular_name' => __('分類'),
            'search_items' => __('Search Categories'),
            'all_items' => __('Categories'),
            'parent_item' => __('父類'),
            'parent_item_colon' => __('父類:'),
            'edit_item' => __('修改分類'),
            'update_item' => __('更新分類'),
            'add_new_item' => __('新增分類'),
            'new_item_name' => __('新增分類'),
            'menu_name' => __('分類')
        );
        register_taxonomy('forum_category', 'forum', array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'taxonomy' => 'category',
            'rewrite' => array(
                'slug' => 'forum_category',
                'hierarchical' => true,
            )
        ));
    }
}
