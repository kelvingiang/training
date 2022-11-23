<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-12">
        <ul class="list-group">
            <li class="list-group-item active" aria-current="true" style=""><?php _e('Member') ?></li>
            <?php
                $args = array(
                    'post_type' => 'member',
                    'posts_per_page' => 5,
                    'post_status' => 'publish',
                    // 'category_name' => 'member-member_group',
                    // 'meta_query' => array(
                    //     array(
                    //         'key' => '_member-member_group',
                    //         'value' => '0',
                    //         'compare' => '='
                    //     )
                    // )
                );
                $wp_query = new WP_Query($args);
                if ($wp_query->have_posts()):
                    while ($wp_query->have_posts()):
                        $wp_query->the_post();
                        ?>
                        <li class="list-group-item member-group">
                            <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                        </li>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                wp_reset_query();
            ?>
        </ul> 
    </div>
    <div class="col-xl-6 col-lg-6 col-md-12">
        <h1 class="member-title-category">Memeber Group</h1>
        <?php 
        $argsCate = array(
            'type' => 'member',
            'posts_per_page' => -1,
            'taxonomy' => 'member-member_group',
            'hide_empty' => 0,
            'parent' => 0,
        );
        $categories = get_categories($argsCate);
        foreach ($categories as $cate) { ?>
        <div class="list-group member-group">
            <!-- goi den archive.php -->
            <?php $url = get_term_link($cate->slug, $cate->taxonomy);?>
            <a href="<?php echo $url ?>"><?php echo $cate->name; ?> </a>
        </div>
        <?php } ?>  
    </div>
</div>    


