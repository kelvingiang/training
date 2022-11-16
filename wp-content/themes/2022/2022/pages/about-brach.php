<?php
/*
  Template Name: About Brach Page
 */
?>
<?php
ob_start();  // neu bao loi PHP Warning: Cannot modify header information ??headers already sent by
get_header();
?>
<div class="row">
    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-4 col-12">
        <div class='head-title'>
            <div class="title">
                <h2 class="head"> <?php _e('分會介紹'); ?> </h2>
            </div>
        </div>
        <?php
        $arrRec1 = array(
            'post_type' => 'brach',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'meta_value',
            'order' => 'DESC',
            'meta_key' => '_metabox_order_by',
        );
        $myQuery1 = new WP_Query($arrRec1);
        ?>
        <div class="brach-list">
            <?php
            global $post;
            if ($myQuery1->have_posts()) :
                while ($myQuery1->have_posts()) :
                    $myQuery1->the_post();
                    $postMeta = get_post_meta($post->ID);
            ?>
                    <div class="brach-item">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h3><?php the_title() ?></h3>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="label-title"> 會長 : <i style="color: #666"><?php echo $postMeta['b_contact'][0]; ?></i> </label>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left: 0px">
                                <div class="col-md-4 col-sm-4 col-xs-12"><label class="label-title"> 電話 : <i style="color: #666"><?php echo $postMeta['b_phone'][0]; ?></i></label></div>
                                <div class="col-md-4 col-sm-4 col-xs-12"><label class="label-title"> 手機 : <i style="color: #666"><?php echo $postMeta['b_tel'][0]; ?></i> </label></div>
                                <div class="col-md-4 col-sm-4 col-xs-12"><label class="label-title"> 電傳 : <i style="color: #666"><?php echo $postMeta['b_fax'][0]; ?></i></label></div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12"><label class="label-title"> 電郵信箱 : <i style="color: #666"> <?php echo $postMeta['b_email'][0]; ?></i></label></div>
                            <div class="col-md-6 col-sm-6 col-xs-12"><label class="label-title"> 網站 : <i style="color: #666"> <a style="font-weight: bold" href="http://<?php echo $postMeta['b_website'][0]; ?>" target="_bank"><?php echo $postMeta['b_website'][0]; ?></a></i></label></div>

                            <div class="col-md-12 col-sm-12 col-xs-12"><label class="label-title"> 地址 : <i style="color: #666"><?php echo $postMeta['b_address'][0]; ?></i></label></div>
                            <div class="col-md-10 col-sm-10 col-xs-10"> </div>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <!-- <a href=" <?php the_permalink() ?>" class="btn-sm"><?php _e('細 節', 'suite'); ?></a> -->
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
        <?php get_sidebar('friendlink') ?>
    </div>
</div>
<?php
get_footer();
ob_flush();   // neu bao loi PHP Warning: Cannot modify header information ??headers already sent by
