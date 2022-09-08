<?php get_header()?>

<section id="content" role="main" style="margin: 100px;">
    <h2 style="font-size: 30px; font-weight:bold">Info member <?php the_title(); ?></h2>
    <div class="">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="meta-row">
            <div class="title-cell">
                <label><?php echo __('Contact'); ?>: </label> 
                <span><?php echo get_post_meta(get_the_ID(),'_metabox_member_contact',true); ?></span>
            </div>
        </div> 
        <div class="meta-row">
            <div class="title-cell">
                <label><?php echo __('Address'); ?>: </label> 
                <span><?php echo get_post_meta(get_the_ID(),'_metabox_member_address',true); ?></span>
            </div>
        </div>
        <div class="meta-row">
            <div class="title-cell">
                <label><?php echo __('Phone'); ?>: </label> 
                <span><?php echo get_post_meta(get_the_ID(),'_metabox_member_phone',true); ?></span>
            </div>
        </div>
        <div class="meta-row">
            <div class="title-cell">
                <label><?php echo __('District'); ?>: </label> 
                <span><?php echo get_post_meta(get_the_ID(),'_metabox-member_district',true); ?></span>
            </div>
        </div> 

            <?php  //get_template_part( 'entry' ); ?>
            <?php  //if ( ! post_password_required() ) comments_template( '', true ); ?>
            <?php
            endwhile;
        endif;
        ?>
    </div>
    <footer class="footer">
        <?php //get_template_part('nav', 'below-single'); ?>
    </footer>
</section>
<?php get_footer() ?>

