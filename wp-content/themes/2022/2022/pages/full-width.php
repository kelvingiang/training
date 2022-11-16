<?php
/*
  Template Name: Full Width
 */
?>
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
                       endwhile;
                   else :
                       get_template_part('content','none');
                   endif;
          ?>
     </div>
 </div>
 
 
 <?php
 // lay phan footer
 get_footer();
?>