<?php
$arr = array(
    'post_type' => 'advertising',
    'posts_per_page' => -1,
    'orderby' => 'ID',
    'order' => 'DESC',
    //            'meta_query' => array(array('key' => '_admin_metabox_special', 'value' => 'off',))
);
$my_query = new WP_Query($arr);
if ($my_query->have_posts()) {
?>
    <div id='checkInCarousel'>
        <ul>
            <?php
            while ($my_query->have_posts()) {
                $my_query->the_post();
                $images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                $objImageData = get_post(get_post_thumbnail_id(get_the_ID()));
                $strAlt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
            ?>
                <li class="ad-list-item">
                    <img src="<?php echo $images[0]; ?>" alt="<?php echo $strAlt; ?>" title="<?php echo $objImageData->post_title; ?>" />
                    <label><?php the_title(); ?></label>
                </li>
            <?php
            }
            wp_reset_query();
            wp_reset_postdata();
            ?>
        </ul>
    </div>
<?php
}
?>

<script type='text/javascript'>
    jQuery(function() {
        jQuery("#checkInCarousel").jCarouselLite({
            //        btnNext: ".bounceout .next",
            //        btnPrev: ".bounceout .prev",
            visible: 2, // so item hien thi

            // CAC HIEU UNG
            //  easing: "easeOutBounce",  // hieu ung khi chuyen dong
            auto: 1500 * 2,
            speed: 2000,
            circular: true, // xoay vong lai item khi xem
            autoWidth: true,
            responsive: true,
            vertical: true, // hinh thi kieu ngang hay doc
            hoverPause: true,
        });

    });
</script>