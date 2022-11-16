<?php
// dien kien where de lay du lieu
$arr = array(
    'post_type' => 'friend',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'meta_key' => '_metabox_order',
);
$myQuery1 = new WP_Query($arr);

?>
<!--  
    phan nay kiem tra bang ajax, code xu ky ajax dc viet tai file js va dc add vao o dau trang (checkajax.js)
-->
<div>
    <!-- <div class='head-title'>
        <h2 class="head"><?php // _e('Friend Link') 
                            ?> </h2>
    </div> -->
    <div>
        <ul class="link-list">
            <?php
            global $post;
            if ($myQuery1->have_posts()) :
                while ($myQuery1->have_posts()) :
                    $myQuery1->the_post();
                    $postMeta = get_post_meta($post->ID);
            ?>
                    <li>
                        <a href="<?php echo $postMeta['p_web'][0]; ?>" target="_blank" rel="nofollow" class="link-style">
                            <?php echo $postMeta['p_name'][0] ?>
                        </a>
                    </li>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            wp_reset_query();
            ?>
        </ul>
    </div>
</div>
</div>