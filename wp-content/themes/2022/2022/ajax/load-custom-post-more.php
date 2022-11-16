<?php

define('WP_USE_THEMES', false);
require('../../../../wp-load.php');
$lastID = $_POST['lastID'];
$post = $_POST['post'];
$category = $_POST['category'];
$categoryName = $_POST['categoryName'];
$language = $post['language'];

$args = array(
    'post_type' => $post,
    $categoryName => $category,
    'posts_per_page' => COUNT_POST_MORE,
    'offset' => $lastID,
    'orderby' => 'date',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key'       => '_metabox_language',
            'value'     =>  $_SESSION['languages'],
            'compare'   => '=',
        ),
    ),
);
$wp_query = new WP_Query($args);

if ($wp_query->have_posts()) {
    $stt = $lastID + 1;
    while ($wp_query->have_posts()) : $wp_query->the_post();
        if ($mainPostID == get_the_ID()) {
            continue;
        }
        $html .= "<li data-id = '" . $stt . "'>";
        $html .= "<a class='link-style' href = '" . get_the_permalink() . "'>" . get_the_title() . "</a>";
        $html .= "</li>";
        $stt += 1;
    endwhile;
    $response = array(
        'status' => 'done',
        'html' => $html,
    );
} else {
    $response = array(
        'status' => 'empty',
    );
}

echo json_encode($response);
