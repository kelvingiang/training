<div id="brach-logo">
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

            if (get_the_title() == '越南總會') {
                continue;
            }

            if (!empty(get_the_post_thumbnail_url())) {
                $imgSrc = get_the_post_thumbnail_url();
            } else {
                $imgSrc = PART_IMAGES . 'no-image.jpg';
            }

            if (empty(get_post_meta(get_the_ID(), 'b_website', true))) {
                $link = get_permalink();
            } else {
                $link = get_post_meta(get_the_ID(), 'b_website', true);
            }
    ?>

            <div class="brach-item">
                <div class="brach-logo">
                    <a href="<?php echo $link; ?>" <?php echo get_post_meta(get_the_ID(), 'b_website', true) != '' ? 'target="_blank"' : '' ?>>
                        <img src="<?php echo $imgSrc ?>" alt="<?php echo $strAlt; ?>" title="<?php echo $objImageData->post_title; ?>" />
                    </a>
                </div>
                <div class="brach-title">
                    <a href="<?php echo $link; ?>" <label style="margin-left: -1.5rem"><?php the_title(); ?></label>
                    </a>
                </div>
            </div>
    <?php
        }
        wp_reset_postdata();
        wp_reset_query();
    }
    $item = 5;
    ?>
</div>
<div class="brach-open">
    <i id="open-icon" class="fa fa-angle-double-up fa-rotate-0 " aria-hidden="true"></i>
</div>
<div class="clearout"></div>
<script>
    jQuery(document).ready(function() {

        jQuery('#open-icon').click(function() {

            if (jQuery('#brach-logo').css('display') === 'none') {
                jQuery('#brach-logo').slideDown(1000);
                jQuery('#open-icon').removeClass('fa-rotate-180').addClass('fa-rotate-0');
            } else {
                jQuery('#brach-logo').slideUp(1000);
                jQuery('#open-icon').removeClass('fa-rotate-0').addClass('fa-rotate-180');

            }
        });
    });
</script>