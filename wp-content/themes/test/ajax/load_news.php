<?php

define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

$offset = $_POST['id'];
global $wp_query;

while ($wp_query->have_posts()):
    $wp_query->the_post();

    $html = "<div class='slider-multi-item-travel' data_id = '" . ++$offset . ">" +
                "<div class='slider-multi-img'>" +
                    "<?php 
                        $url = " . wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                    "?>" +
                    "<img src='" . $url[0] . " class='w-100 img' />
                </div>" +
                "<div class='slider-multi-title'>" +
                    "<a href='" . the_permalink() . ">" . the_title() . "</a>
                </div>" +
                "<div class='slider-multi-content'>" +
                    "<span>" . the_content() . "</span>
                </div>" +
                "<div class='slider-multi-read-more'> " +
                    "<a href='" . get_the_permalink() . "'>" . esc_html_e('Đọc thêm', 'ntl-csw') . "</a>
                </div>
            </div>";

endwhile;
$response = array(
    'status' => 'done',
    'html' => $html,
);

echo json_encode($response);