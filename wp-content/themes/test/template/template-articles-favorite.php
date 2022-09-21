<?php
global $post;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'category_name' => 'Favorite',
    // 'meta_query' => array(
    //     array(
    //         'key' => '_metabox_show_at_home',
    //         'value' => '1',
    //         'compare' => '='
    //     )
    // )    
    
);
$wp_query = new WP_Query($args);
?>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="slider-multi-head"><h1></h1></div>
    <?php
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?>
                <div class="slider-multi-item col-md-6">
                    <div class="slider-multi-img">
                        <?php 
                            // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                            $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                        ?>
                        <img src="<?php echo $url[0]; ?>" class="w-100 img" />
                    </div>
                    <div class="slider-multi-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                    </div>
                    <div class="slider-multi-content">
                        <span ><?php the_content() ?></span>
                    </div>
                    <div class="slider-multi-read-more">
                        <a href="<?php echo get_the_permalink()?>"><?php esc_html_e('Đọc thêm', 'ntl-csw') ?></a>
                    </div>
                </div>
                
                <?php
            endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
    ?>
</div>
