<?php get_header(); ?>
<!-- hien thi slider trang home -->
<div><?php mySlider(3); ?></div>
<div>
    <div class="container-fluid">
        <h2 class="home-title">ARTICLES</h2>
        <div class="hr3"></div>
        <?php get_template_part('template/template', 'articles'); ?>
    </div>
    <div class="container-fluid">
        <h2 class="home-title">NEWS</h2>
        <div class="hr3"></div>
        <?php get_template_part('template/template', 'news'); ?>
    </div>
    <div><?php get_template_part('template/template', 'slider-multi'); ?></div>
</div>
<?php get_footer();