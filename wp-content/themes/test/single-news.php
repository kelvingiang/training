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

?>
<div class="container" style="margin-top: 100px;">
    <span class="single-head"><?php echo get_the_date(); ?> | by Admin</span>
    <div class="row">
        <div class="col-md-8">
            <h2 class="single-title"><?php the_title() ?></h2>
            <div class="sing-content ">
                <?php the_content() ?>
            </div>
            <?php get_template_part('template/template', 'single-news-latest')?>
        </div>
        <div class="col-md-4">
            <!-- archive -->
            <div class="single-archive-list">
                <div class="single-archive-title">
                    <h2><?php echo('Bài viết lưu trữ') ?></h2>        
                </div>
                <div class="single-archive-title-child">
                    <h5><?php echo('Theo tháng') ?></h5>
                    <ul class="single-archive-item">
                        <li><?php wp_get_archives('type=monthly') ?></li>
                    </ul>
                </div>
                <div class="single-archive-title-child">
                    <h5><?php echo('Theo cùng danh mục') ?></h5>
                    <ul class="single-archive-item">
                        <?php 
                        $categories = get_categories( array(
                            'taxonomy' => 'news_category',
                            'orderby' => 'name',
                            'order' => 'ASC',
                        ));
                        foreach($categories as $category) {
                           echo '<li><i class="fas fa-caret-right"></i><a href="">' . $category->name . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- relate -->
            <div style="margin-top: 30px;">
                <h3 class="single-relate-title"><?php echo('Bài viết liên quan') ?></h3>
                <div class="hr3"></div>
                <?php 
                $wp_query = new WP_Query($args);
                if ( $wp_query->have_posts()) { 
                    echo  '<ul>' ; 
                    while ( $wp_query->have_posts()) {  
                        $wp_query->the_post()?> 
                    <li class="single-relate-item"> 
                        <a href = "<?php  the_permalink ();?> " > <?php the_title ( ); ?> </a> 
                    </li> <?php }
                    echo '</ul>' ; } else {  }
                    wp_reset_postdata ();
                    wp_reset_query();
                ?>
            </div>
        </div>
    </div>
    </div>
<?php get_footer(); ?>