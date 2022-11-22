<?php
/*
  Template Name:  News Health Page (Test)
 */
?>
<?php get_header(); ?>
<div class="container-fluid">
  <div class="row">
      <!-- gọi đến trang template-news-health.php -->
      <?php get_template_part('template/template', 'news-health'); ?>
  </div>
</div>
<?php get_footer();