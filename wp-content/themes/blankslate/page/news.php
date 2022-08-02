<?php
/*
  Template Name:  News
 */
?>
<?php get_header(); ?>

<div class="row" style="padding-top: 30px" >
    <div class=" first-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <?php get_sidebar('category'); ?>
    </div>
    <div class="second-space col-lg-9 col-md-8 col-sm-12 col-xs12">

        <?php
        $categories = get_categories(array(
            'orderby' => 'name',
            'parent' => 0
        ));
        ?>

        <?php foreach ($categories as $cat) { ?>
            <div class="group-border">
                <div class="group-title">
                    <label><?php echo $cat->name; ?></label>
                </div>
                <div>
                    <ul class="article-list">
                        <?php
                        global $wp_query;
                        $news_team = array(
                            'post_type' => 'post',
                            'posts_per_page' => 5,
                            'orderby' => 'ID',
                            'order' => 'DESC',
                            'cat' => $cat->cat_ID);
                        $wp_query = new WP_Query($news_team);

                        if ($wp_query->have_posts()):
                            while ($wp_query->have_posts()):
                                $wp_query->the_post();
                                ?>
                                <li>
                                    <a class="article-title" href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                                </li>
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        <?php } ?>

        <div><?php get_template_part('component/template', 'multi-silder') ?></div>
    </div>

    <div class=" last-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <?php get_sidebar('mobile'); ?>
    </div>

</div>
<?php
get_footer();
