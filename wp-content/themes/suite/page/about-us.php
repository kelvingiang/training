<?php
/*
  Template Name: About Us
 */
?>
<?php get_header(); ?>
<form action="" method="post" enctype="multipart/form-data" id="f-schedule" name="f-schedule" >
    <div class="title-row">
        <h2> <?php echo __('Commerce Setting') ?></h2>
    </div>
    <!-- name -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Commerce Name'); ?> : <?php echo get_option('commerce_name') ?></label>
        </div>
    </div>   
    <!-- address -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Address'); ?> : <?php echo get_option('commerce_address') ?></label>
        </div>
    </div>
    <!-- mobile -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Mobile'); ?> : <?php echo get_option('commerce_mobile') ?></label>
        </div>
    </div>
    <!-- phone -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Phone'); ?> : <?php echo get_option('commerce_phone') ?></label>
        </div>
    </div>
    <!-- fax -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Fax'); ?> : <?php echo get_option('commerce_fax') ?></label>
        </div>
    </div>
    <!-- email -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Email'); ?> : <?php echo get_option('commerce_email') ?></label>
        </div>
    </div>
    <!-- map x - map y -->
    <div class="title-cell">
        <label><?php echo __('Maps X'); ?> : <?php echo get_option('commerce_map_x') ?></label>
    </div>
    <div class="title-cell">
        <label><?php echo __('Map Y'); ?> : <?php echo get_option('commerce_map_y') ?></label>
    </div>  

    <!-- CUSTOM POST -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Chamber of Commerce'); ?>
                : <?php get_post_meta('1', '_info_charter', TRUE) ?></label>
        </div>
    </div>
    
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Application for membership'); ?> 
            : <?php get_post_meta('1', '_info_apply', TRUE) ?></label>
        </div>
    </div>

</form>




<?php
get_footer();