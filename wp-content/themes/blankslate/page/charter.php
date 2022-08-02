<?php
/*
  Template Name: charter
 */
?>
<?php get_header(); ?>

<div class="row" style="padding-top: 30px" >
    <div class="first-space col-lg-3 col-md-4 col-sm-12">
        <?php get_sidebar(); ?>
    </div>
    <div class="second-space col-lg-9 col-md-8 col-sm-12">
        <div class="group-border">
            <div class="group-title">
                <label><?php _e('Chamber Charter') ?></label>
            </div>
            <div style="margin: 10px 15px; letter-spacing: 1px; ">
                <?php
                echo get_post_meta('1', '_info_charter', TRUE);
                //$charter = get_post(1);
               // echo $charter->post_content;
                ?>
            </div>
        </div>
    </div>
    <div class="last-space col-lg-3 col-md-4 col-sm-12">
        <?php get_sidebar('mobile'); ?>
    </div>
</div>
<?php get_footer(); 