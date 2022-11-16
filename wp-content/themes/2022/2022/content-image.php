<article id=" post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <div class="entry-thumbnail">
        <?php suite_thumbnail('large'); ?>
    </div>
    <div class="entry-header">
        <?php suite_entry_header(); ?>
        <?php $attachments = get_children(array('post_parent' => $post->ID));
                  $attachment_number = count($attachments);
                  printf(__('this image post contain %1$s photo','suite'),$attachment_number);
        ?>
    </div>
    <div class="entry-content">
        <?php suite_entry_content(); ?>    
        <?php (is_single() ? suite_entry_tag():''); ?>
    </div>

</article>
