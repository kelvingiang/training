<?php
global $post;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'category_name' => 'Latest',
    'meta_query' => array(
        array(
            'key' => '_metabox_show_at_home',
            'value' => '1',
            'compare' => '='
        )
    )
);
$wp_query = new WP_Query($args);
?>
<div id="president-post" >
    <div class="owl-carousel owl-theme">
    <?php
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?>
                <div class="item multi-item">
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
                        <span><?php the_content() ?></span>
                    </div>
                </div>
                
                <?php
            endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
    ?>
    </div>
</div>
<script>
    jQuery(document).ready(function() {
         jQuery('#president-post .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true,
            auotplayTimeout: 5000,
            dots: false,
            autoplayHoverPause: true,
            items: 2,
            navText: ["<i class='fa fa-chevron-left sli-left'></i>",
                "<i class='fa fa-chevron-right sli-right'></i>"
            ],
            // responsive:{
            //     0:{
            //         items:1
            //     },
            //     600:{
            //         items:3
            //     },
            //     1000:{
            //         items:5
            //     }
            // }

        });
    })
</script>