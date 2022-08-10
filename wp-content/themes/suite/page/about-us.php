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
            <label><?php echo __('Commerce Name'); ?>: </label> <span><?php echo get_option('commerce_name') ?></span>
        </div>
    </div>   
    <!-- address -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Address'); ?>: </label> <span><?php echo get_option('commerce_address') ?></span>
        </div>
    </div>
    <!-- mobile -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Mobile'); ?>: </label> <span><?php echo get_option('commerce_mobile') ?></span>
        </div>
    </div>
    <!-- phone -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Phone'); ?>: </label> <span><?php echo get_option('commerce_phone') ?></span>
        </div>
    </div>
    <!-- fax -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Fax'); ?>: </label> <span><?php echo get_option('commerce_fax') ?></span>
        </div>
    </div>
    <!-- email -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Email'); ?>: </label> <span><?php echo get_option('commerce_email') ?></span>
        </div>
    </div>
    <!-- map x - map y -->
    <div class="title-cell">
        <label><?php echo __('Maps X'); ?>: </label> <span><?php echo get_option('commerce_map_x') ?></span>
    </div>
    <div class="title-cell">
        <label><?php echo __('Map Y'); ?>: </label> <span><?php echo get_option('commerce_map_y') ?></span>
    </div>  

    <!-- CUSTOM POST -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Chamber of Commerce'); ?>: </label> <span><?php echo get_post_meta('1', '_info_charter', TRUE) ?></span>
        </div>
    </div>
    
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Application for membership'); ?>: </label> <span><?php echo get_post_meta('1', '_info_apply', TRUE) ?></span>
        </div>
    </div>

</form>




<?php
get_footer();