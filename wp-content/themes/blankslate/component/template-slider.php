<?php
$args = array(
    'post_type' => 'slider',
    'posts_per_page' => -1,
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'meta_key' => '_metabox_order',
);
$wp_query = new WP_Query($args);
global $post;
?>
<div style="padding-top: 113px">
    <div class="fluid_container">
        <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
            <?php if ($wp_query->have_posts()) : ?>
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                    <?php $url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                    <?php $thumb = $url[0] . '&amp;w=100&amp;h=75&amp;a=t&amp;q=100'; ?>
                    <div data-thumb="<?php echo $thumb ?>" data-src="<?php echo $url[0]; ?>">
                        <div class="camera_caption fadeFromBottom"><?php the_title(); ?></div>
                    </div>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            wp_reset_query();
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">

    jQuery(function () {
        // kieu chay slider 1	
        jQuery('#camera_wrap_1').camera({
            //thumbnails: true,
            height: '450px',
            pagination: false,
            thumbnails: false,
            //  imagePath: '/html/themes/classic/images/'
        });
    });

</script>