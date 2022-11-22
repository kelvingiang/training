<?php
/*
  Template Name:  News Culinary Page (Test)
 */
?>
<?php get_header(); ?>
<div class="container-fluid">
  <div class="row">
      <!-- gọi đến trang template-news-culinary.php -->
      <?php get_template_part('template/template', 'news-culinary'); ?>
  </div>
</div>
<?php get_footer();