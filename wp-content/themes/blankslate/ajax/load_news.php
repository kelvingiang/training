<?php

define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

$offset = $_POST['id'];
$cateID = $_POST['id'];
echo $cateID;
global $wp_query;

while ($wp_query->have_posts()):
    $wp_query->the_post();

    $html .= "<li class='itemRow'  data_id =" . ++$offset . ">";
    $html .= "<a class='article-title'  href='" . get_permalink() . "'>" . get_the_title() . "</a>";
    $html .= "</li>";

endwhile;
$response = array(
    'status' => 'done',
    'html' => $html,
);

echo json_encode($response);
