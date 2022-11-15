<?php get_header(); ?>
<div>
    <div>
        <h2 class="home-title">ARTICLES</h2>
        <div class="hr3"></div>
        <?php get_template_part('template/template', 'articles'); ?>
    </div>
    <div>
        <h2 class="home-tit;e">NEWS</h2>
        <div class="hr3"></div>
        <?php get_template_part('template/template', 'news'); ?>
    </div>
    <div><?php get_template_part('template/template', 'slider-multi'); ?></div>
</div>
<?php get_footer();