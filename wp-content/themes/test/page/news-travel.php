<?php
/*
  Template Name:  News Travel Page (Test)
 */
?>
<?php get_header(); ?>
<div class="container-fluid">
  <div class="row">
      <!-- gọi đến trang template-news-travel.php -->
      <?php get_template_part('template/template', 'news-travel'); ?>
  </div>
</div>
<?php get_footer();