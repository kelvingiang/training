<?php
/*
  Template Name:  Articles Latest Page (Test)
 */
?>
<?php get_header(); ?>

<div class="row" style="margin-top: 100px">

    <!-- gọi đến trang template-articles-latest.php -->
    <?php get_template_part('template/template', 'articles-latest'); ?>
</div>

<?php get_footer();