<ul id="flexisel-breach">
    <?php
    $arr = array(
        'post_type' => 'brach',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'meta_key' => '_metabox_order_by',
    );

    $my_query = new WP_Query($arr);

    if ($my_query->have_posts()) {
        while ($my_query->have_posts()) {
            $my_query->the_post();
            echo the_post_thumbnail_url();
            if (!empty(get_the_post_thumbnail_url())) {
                //                $images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                //                $objImageData = get_post(get_post_thumbnail_id(get_the_ID()));
                //                $strAlt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                $imgSrc = get_the_post_thumbnail_url();
            } else {
                $imgSrc = PART_IMAGES . 'no-image.jpg';
            }
    ?>
            <li>
                <a href="<?php echo permalink_link(); ?>">
                    <div class="box">
                        <img src="<?php echo $imgSrc ?>" alt="<?php echo $strAlt; ?>" title="<?php echo $objImageData->post_title; ?>" />
                        <br>
                        <label> <?php the_title(); ?></label>
                    </div>
                </a>
            </li>
    <?php
        }
        wp_reset_postdata();
        wp_reset_query();
    }
    $item = 5;
    ?>
</ul>
<div class="clearout"></div>
<script type="text/javascript">
    jQuery("#flexisel-breach").flexisel({
        visibleItems: <?php echo $item ?>,
        animationSpeed: 1000,
        autoPlay: true,
        autoPlaySpeed: 3000,
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
        vertical: false,
        responsiveBreakpoints: {
            portrait: {
                changePoint: 480,
                visibleItems: 1
            },
            landscape: {
                changePoint: 640,
                visibleItems: 2
            },
            tablet: {
                changePoint: 768,
                visibleItems: 3
            }
        }
    });
</script>