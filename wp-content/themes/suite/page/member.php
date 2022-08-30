<?php
/*
  Template Name:  Member Page 
 */
?>
<?php get_header(); ?>
<div class="row" style="margin-top: 100px">
    <div class="first-space ">
        <div class="row">
            <!-- gọi đến trang template-member.php -->
            <div class=" member col-lg-12"><?php get_template_part('template/template', 'member'); ?></div> 
        </div>    
    </div>
</div>
<?php get_footer();