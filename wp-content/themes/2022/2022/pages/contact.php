<?php
/*
  Template Name: Contact
 */
?>
 <?php get_header(); ?>
<div class="row">
    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-12">
        <div class="contact-info">
            <h4>dia chi lien lac</h4>            
            <p>123 tran hung dao quan 1 tphcm</p>
            <p>so dien thoai</p>
        </div>
        <!-- cai them plugin form 7 de lay cau shortcode dan vao day -->
        <div class="contact-info">
            <?php echo do_shortcode('[contact-form-7 id="1466" title="Contact form 1"]') ?>
        </div>
    </div>
    
    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer();
