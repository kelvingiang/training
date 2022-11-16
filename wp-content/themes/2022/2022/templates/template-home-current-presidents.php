<div>
    <div style="padding-top: 2rem">
        <div id="supervisor-slider" class="behind-space">
            <div class=" owl-carousel owl-theme supervisor-slider-list">
                <?php
                $args = array(
                    'post_type' => 'supervisor',
                    'posts_per_page' => -1,
                    'meta_query' => array(array('key' => '_admin_metabox_special', 'value' => 'on',)),
                    'orderby' => 'meta_value',
                    'order' => 'DESC',
                    'meta_key' => '_metabox_order',
                );
                $Query = new WP_Query($args);

                if ($Query->have_posts()) :
                    while ($Query->have_posts()) :
                        $Query->the_post();
                        $images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                ?>
                        <div class="supervisor-slider-item animation-item ">
                            <h3 class="h3-title"> <?php the_title(); ?> </h3>
                            <img src="<?php echo $images[0]; ?>" alt="<?php echo get_the_title(); ?>" />
                            <label><?php the_content(); ?></label>

                        </div>
                <?php
                    endwhile;
                endif;
                wp_reset_query();
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function() {

        var count = 0;
        bsContainerWidth = jQuery("body").width()
        if (bsContainerWidth <= 500) {
            var count = 1;
        } else if (bsContainerWidth <= 950) {
            var count = 2;
        } else if (bsContainerWidth <= 1170) {
            var count = 3;
        } else {
            var count = 3;
        }

        jQuery('#supervisor-slider .owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: false,
            auotplayTimeout: 50000,
            dots: false,
            autoplayHoverPause: true,
            items: count,
            navText: ["<i class='fa fa-chevron-left supervisor-left'></i>",
                "<i class='fa fa-chevron-right supervisor-right'></i>"
            ]

        });


    });
</script>