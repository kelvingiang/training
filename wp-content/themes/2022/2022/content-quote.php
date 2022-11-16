<article id=" post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <div class="entry-thumbnail">
        <?php suite_thumbnail('thumbnail'); ?>
    </div>
    <div class="entry-header">
        <?php suite_entry_header(); ?>
        <?php suite_entry_meta(); ?>
    </div>
    <div class="entry-content">
        <?php suite_entry_content(); ?>    
        <?php (is_single() ? suite_entry_tag():''); ?>
    </div>

</article>
