<?php get_header(); ?>
<div>
    <span class="single-head"><?php echo get_the_date(); ?> | by <?php echo get_the_author()?></span>
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12">
            <h2 class="single-title"><?php the_title() ?></h2>
            <div class="sing-content "><?php the_content() ?></div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-12">
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
                $cate_id = array();
                $current_category = get_the_terms(get_the_ID() , 'news_category' );
                foreach($current_category as $cc){
                    $cate_id[] = $cc->term_id;
                }
                $wp_query = new WP_Query(getRelatePostNews('news', 5, $cate_id));
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
    <?php get_template_part('template/template', 'single-news-latest')?>
    </div>
<?php get_footer(); ?>