<?php
/*
  Template Name: About Regulation Page
 */
get_header();
?>
<div>
    <div class='head-title-<?php echo $_SESSION['languages'] ?>'>
        <h2> <?php _e('The Council of Taiwanese Chambers Regulation') ?> </h2>
    </div>
    <div class="info-bg">
        <?php echo get_post_meta('1', '_regulation_' . $_SESSION['languages'], true) ?>
    </div>
</div>
<div>
    <?php get_template_part('templates/template', 'footer') ?>
</div>
<?php
get_footer();
ob_flush();   // neu bao loi PHP Warning: Cannot modify header information ??headers already sent by
