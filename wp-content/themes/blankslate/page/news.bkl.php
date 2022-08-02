<?php
/*
  Template Name:  Newssdfsdfsdafasdf
 */
?>
<?php get_header(); ?>

<div class="row" style="padding-top: 30px" >
    <div class=" first-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
       <?php get_sidebar(); ?>
    </div>
    <div class="second-space col-lg-9 col-md-8 col-sm-12 col-xs12">
        <div class="group-border">
            <div class="group-title">
                <label><?php _e('News'); ?></label>
            </div>
            <div>
                <ul class="article-list">
                    <?php
                    global $wp_query;
                    if (get_query_var('paged')) {
                        $paged = get_query_var('paged');
                    } elseif (get_query_var('page')) {
                        $paged = get_query_var('page');
                    } else {
                        $paged = 1;
                    }

                    $showNum = 50;
                    $offset = ($paged - 1) * $showNum;
                    $news_team = array(
                        'post_type' => 'post',
                        'posts_per_page' => $showNum,
                        'orderby' => 'ID',
                        'order' => 'DESC',
                        'offset' => $offset,
                        'paged' => $paged,
                        'cat' => 4);
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
                <?php
                $_SESSION['offset'] = $offset;
/// CAC PHUONG THUC  PAGING
// PHUONG THUC PAGING THU NHAT
//  posts_nav_link();    
// PHUONG THUC PAGING THU HAI
//next_posts_link(__( 'Previous ' ));
// echo '  |  ';
// previous_posts_link(__( ' Next ' ));
// PHUONG THUC PAGING THU BA
                $big = 999999999; // DAY LA GIA TRI SO TRANG LON NHAT TA CHO 1 SO BAT KY 
                $base = str_replace($big, '%#%', esc_url(get_pagenum_link($big))); //    TAO RA LINK PHANTRANG
                $format = '?page=%#%'; // kieu lay url mac dinh khong nen doi
                $current = max(1, $paged);
                $total = $wp_query->max_num_pages;
                $args = array(
                    'base' => $base,
                    'format' => $format,
                    'total' => $total,
                    'current' => $current,
                    'show_all' => FALSE,
                    'end_size' => 1, // SO TRANG DAU VA CUOI
                    'mid_size' => 2, // SO TRANG HIEN TAI
                    'prev_next' => true,
//                    'prev_text' => __('« Previous'),
//                    'next_text' => __('Next »'),
                    'type' => 'plain', // CAC KIEU HIEN THI HTML ; plain = <a> ; list = <li>; array = tra ve kieu array.
                    'add_args' => false, // ADD THEM GIA TRI TREN URL VD : array ('test' => 'abc')
                    'add_fragment' => '', // ADD THEM PHAN VAO URL VD : &test = abc
                    'before_page_number' => '', // THEM GIA TRI TRUOC  ITEM PHAN TRANG
                    'after_page_number' => ''  // THEM GIA TRI VAO SAU ITEM PHAN TRANG
                );

                // wp_pagenavi();
                wp_reset_postdata();
                wp_reset_query();
                ?>
                <div id="paginate"> 
                    <?php echo paginate_links($args); ?>
                </div>
            </div>
        </div>
         <div><?php get_template_part('component/template', 'multi-silder') ?></div>
    </div>
    <div class=" last-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
       <?php get_sidebar('mobile'); ?>
    </div>

</div>
    <?php get_footer(); ?>