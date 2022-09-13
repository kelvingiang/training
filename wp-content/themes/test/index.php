<?php get_header(); ?>
<div  style="margin-top: 80px">
    <div class="">
        <h2 style="text-align: center; font-size:22px; color:#0870b7;">ARTICLES</h2>
        <div class="hr3"></div>
        <?php get_template_part('template/template', 'articles'); ?>
    </div>
    <div>
        <h2 style="text-align: center; font-size:22px; color:#0870b7;">NEWS</h2>
        <div class="hr3"></div>
        <?php get_template_part('template/template', 'news'); ?>
    </div>
    <div ><?php get_template_part('template/template', 'slider-multi'); ?></div>
</div>
<?php get_footer();