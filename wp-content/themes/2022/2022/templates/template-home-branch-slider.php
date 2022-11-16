<?php
//  global $post, $posts;
$args = array(
    'post_type' => 'slide',
    'posts_per_page' => -1,
    'slide_category' => 'branch',
);
$loop = new WP_Query($args);
?>
<div id="branch-slider">
    <div class="owl-carousel owl-theme branch-slider-list">
        <?php
        if ($loop->have_posts()) :
            while ($loop->have_posts()) :
                $loop->the_post(); ?>
                <div class="branch-slider-item">
                    <?php the_post_thumbnail('', array('class' => $a[$random_keys], 'title' => the_title_attribute('echo=0'))); ?>
                </div>
        <?php
            endwhile;
        endif;
        wp_reset_postdata()
        ?>
    </div>
</div>

<script>
    jQuery(document).ready(function() {

        jQuery('#branch-slider .owl-carousel').owlCarousel({

            loop: true,
            margin: 10,
            nav: true,
            autoplay: false,
            auotplayTimeout: 50000,
            dots: false,
            autoplayHoverPause: true,
            items: 1,
            navText: ["<i class='fa fa-chevron-left branch-left'></i>",
                "<i class='fa fa-chevron-right branch-right'></i>"
            ]

        });


    });
</script>