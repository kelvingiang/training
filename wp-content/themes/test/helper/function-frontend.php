<?php

//======================== POST TYPE ==========================
function getPostType($postType, $showNum, $cateID, $offset, $paged)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post_status' => 'publish',
        'cat' => $cateID,
        // 'meta_query' => array(
        //     array(
        //         'key' => '_metabox_show_at_home',
        //         'value' => '1',
        //         'compare' => '='
        //     )
        // )    
        'orderby' => 'ID',
        'order' => 'DESC',
        'offset' => $offset,
        'paged' => $paged, 
    );
    return $args;
}

function getPostTypeNews($postType ,$showNum , $cateID, $offset, $paged)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post_status' => 'publish',
        //'meta_query' => array(
            //array(
                //'key' => '_metabox_show_at_home',
                //'value' => '1',
                //'compare' => '='
            //)
        //) 
        'tax_query' => array(
            array(
                'taxonomy' => 'news_category',
                'field' => 'term_id',
                'terms'    => $cateID
            ),
        ),
        'offset' => $offset, //lấy bài viết đầu tiên   
        'paged' => $paged,
    );
    return $args;
}

//========================= RELATE POST =====================
function getRelatePostNews($postType, $showNum, $cateID)
{
    // $term = ''; 
    // $terms = get_the_terms( get_the_ID() , 'news_category' );
    // foreach ( $terms as $term ) {
    // $term = $term->slug;
    // }
    $args = array(
        'post_type' => $postType,
        'posts_per_page'=> $showNum,
        'post_status' => 'publish',
        'tax_query' => array(
            'taxonomy' => 'news_category',
            'field' => 'id',
            'terms' => $$cateID,
        ),
        'post__not_in'  => array (get_the_ID()), 
        'orderby' => 'ID',
        'order' => 'DESC',
    );
    return $args;
}