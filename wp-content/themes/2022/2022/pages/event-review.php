<?php
/*
  Template Name: Event Review Page
 */
// neu bao loi PHP Warning: Cannot modify header information ??headers already sent by
get_header();
?>
<div>
    <?php mySlider('supervisors'); ?>
</div>
<div class="row">
    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12" style="margin-bottom: 10px; margin-top:2rem">
        <!-- <div class='head-title'>
            <h2 class="head"> <?php // _e('Event Review'); 
                                ?> </h2>
        </div> -->

        <?php
        $my_query = query_custom_post_list('event', 'event-review', COUNT_POST_NEWEST,  $_SESSION['languages']);
        if ($my_query->have_posts()) {
            while ($my_query->have_posts()) {
                $my_query->the_post();
                $images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
        ?>
                <div class="gray-group">
                    <div class="gray-title">
                        <a class="link-style" href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </div>
                    <div class="gray-content">
                        <?php if (!empty($images[0])) { ?>
                            <div class="has-img">
                                <img src="<?php echo $images[0]; ?>" alt="<?php echo get_the_title(); ?>" />
                                <?php the_content(); ?>
                            </div>
                        <?php } else { ?>
                            <?php the_content(); ?>
                        <?php } ?>
                    </div>
                </div>
        <?php
            }
            wp_reset_postdata();
            wp_reset_query();
        }
        ?>

        <div>
            <?php get_template_part('templates/template', 'post-more') ?>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
        <?php get_sidebar() ?>
    </div>
</div>




<?php
get_footer();
// neu bao loi PHP Warning: Cannot modify header information ??headers already sent by
