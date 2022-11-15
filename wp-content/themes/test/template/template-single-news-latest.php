<?php get_header(); ?>
<?php
global $post;
$args = array(
    'post_type' => 'news',
    'posts_per_page'=> 3,
    'post_status' => 'publish',
    'post__not_in'  => array ($post->ID), 
    'orderby' => 'news_date',
    'order' => 'DESC',
);
$wp_query = new WP_Query($args);
?>
<div style="margin-top: 15px;">
    <h2 class="single-relate-title">Bài viết mới nhất</h2>
    <div class="hr3"></div>
    <?php
        if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                <div class="row" style="margin-bottom:5px">
                    <div class="single-latest-image-col">
                        <?php 
                            // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                            $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                        ?>
                        <img src="<?php echo $url[0]; ?>" class="single-latest-image" />
                    </div>
                    <div class="single-latest-article-col">
                        <div class="single-latest-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>
                        <div class="single-latest-content">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="slider-multi-read-more">
                            <a href="<?php echo get_the_permalink()?>"><?php esc_html_e('Đọc thêm', 'ntl-csw') ?></a>
                        </div>
                    </div>
                    <hr class="hr2">
                </div>
                <?php
            endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
    ?>
</div>
