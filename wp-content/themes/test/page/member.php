<?php
/*
  Template Name:  Member Page
 */
?>
<?php get_header(); ?>

<div class="row" style="padding-top: 30px">
    <div class="first-space col-lg-3 col-md-4 col-sm-12 col-xs-12">

    </div>
    <div class="second-space col-lg-9 col-md-8 col-sm-12 col-xs12">
        <div class="group-border">
            <div class="group-title">
                <label><?php echo __('Member') ?></label>
            </div>
            <div>
                <ul class="article-list">
                    <?php
                    global $wp_query;
                    $member_team = array(
                        'post_type' => 'member',
                        'posts_per_page' => 5, //hiển thị toàn bộ -1
                        'orderby' => 'ID',
                        'order' => 'DESC',
                    );
                    $wp_query = new WP_Query($member_team);

                    if($wp_query->have_posts()):
                        while($wp_query->have_posts()):
                            $wp_query->the_post();
                            ?>
                            <li>
                                <a class="article-title" href="<?php the_permalink(); ?> ">
                                    <?php the_title() ?>
                                </a>
                            </li>
                            <?php
                        endwhile; 
                    endif;       
                    ?>
                </ul>
            </div>
        </div>
    </div>

</div>
<?php get_footer();