<?php
// lay phan header
 get_header();
?>
 <!-- phan noi dung of trang index --------------------------------------- -->
 <div class="content">
     <div id="main-content">
         <div class="archive-title">
        <h2>
                <?php
                        if ( is_tag() ) :
                                printf( __('Posts Tagged: %1$s','suite'), single_tag_title( '', false ) );
                        elseif ( is_category() ) :
                                printf( __('Posts Categorized: %1$s','suite'), single_cat_title( '', false ) );
                        elseif ( is_day() ) :
                                printf( __('Daily Archives: %1$s','suite'), get_the_time('l, F j, Y') );
                        elseif ( is_month() ) :
                                printf( __('Monthly Archives: %1$s','suite'), get_the_time('F Y') );
                        elseif ( is_year() ) :
                                printf( __('Yearly Archives: %1$s','suite'), get_the_time('Y') );
                        endif;
                ?>
        </h2>
     </div>
         <!-- lay thong tin mo ta cua tag hay category -->
         <?php if ( is_tag() || is_category() ) : ?>
        <div class="archive-description">
                <?php echo term_description(); ?>
        </div>
          <?php endif; ?>
         
         <!-- lay cac bai post  -->
         <?php if(have_posts()) : 
                      while (have_posts()) : 
                          the_post();
                       //   the_title();echo '</br>';
                           get_template_part('content', get_post_format());
                       endwhile;
                          suite_pagination();
                   else :
                       get_template_part('content','none');     
                   endif;
          ?>
     </div>

     <div id="sidebar">
         <?php get_sidebar() ?>
     </div>
 </div>
 
 
 <?php
 // lay phan footer
 get_footer();
?>
