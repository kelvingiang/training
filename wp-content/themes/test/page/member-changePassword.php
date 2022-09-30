<?php ob_start()?>
<?php
/*
  Template Name:  Member Change Password Page (Test)
 */
?>
<?php get_header(); ?>

<div class="row">
    <!-- gọi đến trang template-member-logout.php -->
    <?php get_template_part('template/template', 'member-changePassword'); ?>
</div>

<?php get_footer();
ob_end_flush() ?>