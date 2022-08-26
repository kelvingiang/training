<h1>Info product <?php the_title(); ?></h1>
<section id="content" role="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
            <?php // if ( ! post_password_required() ) comments_template( '', true ); ?>
            <?php
        endwhile;
    endif;
    ?>
    <footer class="footer">
        <?php //get_template_part('nav', 'below-single'); ?>
    </footer>
</section>