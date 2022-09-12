<?php ob_start(); //function chuyển trang không bị lỗi?>
<?php
/*
  Template Name:  Member Login Page (Test)
 */
?>
<?php get_header(); ?>

<div class="row" style="margin-top: 100px">
    <!-- gọi đến trang template-member-login.php -->
    <?php get_template_part('template/template', 'member-login'); ?>
</div>
<?php get_footer();
ob_end_flush(); //function chuyển trang không bị lỗi?>