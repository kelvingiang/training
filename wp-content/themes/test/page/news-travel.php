<?php
/*
  Template Name:  News Travel Page (Test)
 */
?>
<?php get_header(); ?>

<div class="row" style="margin-top: 100px">

    <!-- gọi đến trang template-news-travel.php -->
    <?php get_template_part('template/template', 'news-travel'); ?>
</div>

<?php get_footer();