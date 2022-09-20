<?php get_header(); ?>
<?php
global $post;
$term = ''; 
$terms = get_the_terms( get_the_ID() , 'news_category' );
foreach ( $terms as $term ) {
  $term = $term->slug;
}
$args = array(
    'post_type' => 'news',
    'posts_per_page'=> 5,
    'post_status' => 'publish',
    'tax_query' => array(
        'taxonomy' => 'news_category',
        'field' => 'id',
        'terms' => $term,
    ),
    'post__not_in'  => array ($post->ID), 
    'orderby' => 'ID',
    'order' => 'DESC',
);

$wp_query = new WP_Query($args);
?>
<div class="container" style="margin-top: 80px;">
    <span class="single-head"><?php the_date() ?> | by <?php the_author() ?></span>
    <div class="row">
        <div class="col-md-8">
            <h2 class="single-title"><?php the_title() ?></h2>
            <div class="sing-content ">
                <?php the_content() ?>
            </div>
            <div style="margin-top: 30px;">
                <h3>Bài viết liên quan</h3>
                <div class="hr3"></div>
                <?php 
                if ( $wp_query->have_posts()) { 
                    echo  '<ul>' ; 
                    while ( $wp_query->have_posts()) {  
                        $wp_query->the_post()?> 
                    <li> <a href = "<?php  the_permalink ();?> " > <?php the_title ( ); ?> </a> </li> <?php }
                    echo '</ul>' ; } else {  }
                    wp_reset_postdata ();
                    wp_reset_query();
                ?>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    </div>
<?php get_footer(); ?>