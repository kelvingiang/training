<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="padding-top: 2rem">
        <div id="event-slider">
            <div class="owl-carousel owl-theme event-slider-list">
                <?php
                $Query = query_custom_post_list_show_home('event', 'event-review', -1,  $_SESSION['languages']);
                if ($Query->have_posts()) :
                    while ($Query->have_posts()) :
                        $Query->the_post();
                        $images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                        $imgSrc = $images[0] != '' ? $images[0] : PART_IMAGES . 'no-img-400-225.png';
                ?>
                        <div class="event-slider-item animation-item summary-show">
                            <div class="event-slider-time-img">
                                <div class="summary-content">
                                    <?php the_content() ?>
                                </div>
                                <img src="<?php echo $imgSrc; ?>" alt="<?php echo get_the_title(); ?>" />
                            </div>
                            <a href="<?php the_permalink(); ?>" class="link-style">
                                <?php the_title(); ?>
                            </a>
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
</div>
<script>
    jQuery(document).ready(function() {

        // set so luong hien thi thong qua responsive
        var count = 0;
        bsContainerWidth = jQuery("body").width()
        if (bsContainerWidth <= 500) {
            var count = 1;
        } else if (bsContainerWidth <= 950) {
            var count = 2;
        } else if (bsContainerWidth <= 1170) {
            var count = 4;
        } else {
            var count = 4;
        }


        jQuery('#event-slider .owl-carousel').owlCarousel({

            loop: true,
            margin: 10,
            nav: true,
            autoplay: false,
            auotplayTimeout: 50000,
            dots: false,
            autoplayHoverPause: true,
            items: count,
            navText: ["<i class='fa fa-chevron-left sli-left'></i>",
                "<i class='fa fa-chevron-right sli-right'></i>"
            ]

        });

        jQuery('.summary-show').mouseenter(function() {
            jQuery(this).children().children('.summary-content').addClass('summary-start').removeClass('summary-close');

        }).mouseleave(function() {
            jQuery(this).children().children('.summary-content').addClass('summary-close').removeClass('summary-start');

        });
    });
</script>