<?php
/*
  Template Name:  News Digitizing Page (Test)
 */
?>
<?php get_header(); ?>
<div class="container-fluid">
  <div class="row">
      <!-- gọi đến trang template-news-digitizing.php -->
      <?php get_template_part('template/template', 'news-digitizing'); ?>
  </div>
</div>
<?php get_footer();