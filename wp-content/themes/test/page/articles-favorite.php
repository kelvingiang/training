<?php
/*
  Template Name:  Articles Favorite Page (Test)
 */
?>
<?php get_header(); ?>

<div class="row">
    <!-- gọi đến trang template-articles-favorite.php -->
    <?php get_template_part('template/template', 'articles-favorite'); ?>
</div>

<?php get_footer();