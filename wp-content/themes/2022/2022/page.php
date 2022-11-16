<?php
// lay phan header
 get_header();
?>
 <!-- phan noi dung of trang index --------------------------------------- -->
 <div class="content">
     <div id=" main-content">
         <!-- lay cac bai post  -->
         <?php if(have_posts()) : 
                      while (have_posts()) : 
                          the_post();
                           get_template_part('content', get_post_format());
                      //     get_template_part( 'author-bio' );
                         //   comments_template(); 
                       endwhile;
                   else :
                       get_template_part('content','none');
                   endif;
          ?>
     </div>
     <div id="sidebar ">
         <?php  get_sidebar() ?>
     </div>
 </div>
 
 
 <?php
 // lay phan footer
 get_footer();
?>
