<?php
global $post;
$args = array(
    'post_type' => 'slider',
    'posts_per_page' => 5,
    'post_status' => 'publish',
    // 'category_name' => '',
    // 'meta_query' => array(
    //     array(
    //         'key' => '',
    //         'value' => '0',
    //         'compare' => '='
    //     )
    // 
);
$wp_query = new WP_Query($args);
?>
<div class="skitter skitter-large with-dots skitters" style="max-width:initial;">
    <ul>
    <?php
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?>
                <li>
                    <a href="#cubeStop"></a>
                    <?php 
                    // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                    $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                        ?>
                    <img src="<?php echo $url[0]; ?>" class="cubeStop image-skitter"/> 
                </li>
                <?php
            endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
    ?>
    </ul>
</div>
<script>
    jQuery(document).ready(function() {
        //skitter
        jQuery('.skitter-large').skitter({dots: false});
    })
</script>