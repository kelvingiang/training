<div class="row">
    <?php if (is_single()) { ?>
        <div class="col-lg-12"><?php get_template_part('component/template', 'news') ?></div>
        <div class="col-lg-12"><?php get_template_part('component/template', 'event') ?></div>
        <div class="col-lg-12"><?php get_template_part('component/template', 'information') ?></div>
    <?php } elseif (is_page('member')) { ?>
        <div class="col-lg-12"><?php // get_template_part('component/template', 'group-region')        ?></div>
        <div class="col-lg-12"><?php get_template_part('component/template', 'group-industry') ?></div>
        <div class="col-lg-12"><?php get_template_part('component/template', 'event') ?></div>
    <?php } elseif (is_page('successive')) { ?>     
        <div class="col-lg-12"><?php get_template_part('component/template', 'event') ?></div>
        <div class="col-lg-12"><?php get_template_part('component/template', 'news') ?></div>
        <div class="col-lg-12"><?php get_template_part('component/template', 'information') ?></div>
    <?php } else { ?>
        <div class="col-lg-12"><?php// get_template_part('component/template', 'president') ?></div>
        <div class="col-lg-12"><?php get_template_part('component/template', 'category') ?></div>
        <div class="col-lg-12"><?php get_template_part('component/template', 'news') ?></div>
        <div class="col-lg-12"><?php get_template_part('component/template', 'information') ?></div>
    <?php } ?>
</div>