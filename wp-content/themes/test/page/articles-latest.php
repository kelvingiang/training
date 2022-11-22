<?php
/*
  Template Name:  Articles Latest Page (Test)
 */
?>
<?php get_header(); ?>
<div class="container-fluid">
  <div class="row">
      <!-- gọi đến trang template-articles-latest.php -->
      <?php get_template_part('template/template', 'articles-latest'); ?>
  </div>
</div>
<?php get_footer();