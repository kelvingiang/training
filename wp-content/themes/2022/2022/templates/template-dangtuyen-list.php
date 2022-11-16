<?php
// KIEM TRA INPUT BANG FUNCTION TRONG DANG  TUYEN
$arrRec = array(
    'post_type' => 'recruitment',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'recruitment_category' => 'dangtuyen',
    'meta_query' => array(
        array(
            'key' => '_recruit_postby',
            'value' => $_SESSION['login'],
        )
    )
);
$myQuery = new WP_Query($arrRec);
if ($myQuery->have_posts()) :
    echo '<div class="list-item">';
    while ($myQuery->have_posts()) :
        $myQuery->the_post();
?>
        <div class="row-item">
            <div>
                <label>
                    <?php the_title() ?>
                </label>
            </div>
            <div>
                <a class="my-link" href="<?php echo esc_attr(add_query_arg('id', $post->ID)) ?>">
                    <?php _e('Edit_'); ?></a> |
                <a href="#" class="my-link-delete" data-id="del-<?php echo $post->ID ?>" data-href="<?php echo esc_attr(add_query_arg('del', $post->ID)) ?>" data-title=" <?php echo get_the_title($post->ID); ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete">
                    <?php _e('Delete_'); ?></a>
            </div>
        </div>
<?php
    endwhile;
    echo ' </div>';
endif;
wp_reset_postdata();
?>