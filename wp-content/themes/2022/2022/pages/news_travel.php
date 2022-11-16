<?php
/*
  Template Name: News Travel Page
 */
?>
<?php
ob_start();  // neu bao loi PHP Warning: Cannot modify header information ??headers already sent by
get_header();
$category = 'vn-tour';

?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <?php get_template_part('templates/template', 'advertising'); ?>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-12">
        <!-- <div class='head-title'>
            <h2 class="head"> <?php // _e('News Travel'); 
                                ?> </h2>
        </div> -->
        <?php Post_list_style($category, COUNT_POST_NEWEST) ?>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
        <?php get_sidebar() ?>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <?php get_template_part('templates/template', 'footer') ?>
    </div>
</div>
<?php
get_footer();
ob_flush();   // neu bao loi PHP Warning: Cannot modify header information ??headers already sent by
?>