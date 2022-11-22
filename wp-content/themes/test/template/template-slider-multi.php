<?php
global $post;
$args = array(
    'post_type' => 'slider',
    'posts_per_page' => -1,
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
<div id="president-slider" >
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
                    <a href="<?php //the_permalink(); ?>"><?php //the_title() ?></a>
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
<script type="text/javascript">
    jQuery(document).ready(function() {
        //so luong item hien thi thong qua responsive
        var count = 0;
        bodyContainerWidth = jQuery("body").width();
        if(bodyContainerWidth <= 500) {
            var count = 1;
        }else if(bodyContainerWidth <= 950) {
            var count = 2;
        }else if(bodyContainerWidth <= 1170) {
            var count = 4;
        }else {
            var count = 4;
        }

        jQuery('#president-slider .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true,
            auotplayTimeout: 5000,
            dots: false,
            autoplayHoverPause: true,
            items: count,
            navText: ["<i class='fas fa-chevron-left nav-button sli-left'></i>",
                "<i class='fas fa-chevron-right nav-button sli-right'></i>"
            ],
        });
    })
</script>