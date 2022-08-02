<?php get_header(); ?>
<div class="row">
    <div class="first-space col-lg-3 col-md-4 col-sm-12 ">
        <div class="row">
            <div class=" president col-lg-12"><?php get_template_part('component/template', 'president'); ?></div>
            <div class=" link col-lg-12"><?php get_template_part('component/template', 'link'); ?></div>
        </div>
    </div>
    <div class="second-space col-lg-9 col-md-8 col-sm-12 ">
        <div class="row">
            <div class="special col-lg-12"><?php get_template_part('component/template', 'special'); ?></div> 
            <div class="news col-lg-4"><?php get_template_part('component/template', 'news') ?></div>
            <div class="information col-lg-4"><?php get_template_part('component/template', 'information') ?></div>
            <div class="event col-lg-4"><?php get_template_part('component/template', 'event') ?></div>
            <div class="multi-silder col-lg-12"><?php get_template_part('component/template', 'multi-silder') ?></div>
        </div>
    </div>
     <div class="last-space col-lg-3 col-md-4 col-sm-12 ">
        <div class="row">
            <div class="president-2 col-lg-12"><?php get_template_part('component/template', 'president'); ?></div>
            <div class="linh-2 col-lg-12"><?php get_template_part('component/template', 'link'); ?></div>
        </div>
    </div>
</div>
<?php get_footer();?>