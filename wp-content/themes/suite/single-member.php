<h1>Info member <?php the_title(); ?></h1>
<section id="content" role="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h3>Contact name: <?php echo get_post_meta(get_the_ID(),'_metabox_member_contact',true); ?></h3>
            <h3>Address: <?php echo get_post_meta(get_the_ID(),'_metabox_member_address',true); ?></h3>
            <h3>Phone: <?php echo get_post_meta(get_the_ID(),'_metabox_member_phone',true); ?></h3>
            <h3>District: <?php echo get_post_meta(get_the_ID(),'_metabox-member_district',true); ?></h3>
            <?php // get_template_part( 'entry' ); ?>
            <?php // if ( ! post_password_required() ) comments_template( '', true ); ?>
            <?php
        endwhile;
    endif;
    ?>
    <footer class="footer">
        <?php //get_template_part('nav', 'below-single'); ?>
    </footer>
</section>