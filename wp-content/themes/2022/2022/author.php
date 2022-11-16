<?php
// lay phan header
 get_header();
?>
 <!-- phan noi dung of trang index --------------------------------------- -->
 <div class="content">
     <div id="main-content">
         <div class="author-box"><?php
        // Hiển thị avatar của tác giả
        echo '<div class="author-avatar">'. get_avatar( get_the_author_meta( 'ID' ) ) . '</div>';
 
        // hiển thị tên tác giả
        printf( '<h3>'. __( 'Posts by %1$s', 'thachpham' ) . '</h3>', get_the_author() );
 
        // Hiển thị giới thiệu của tác giả
        echo '<p>'. get_the_author_meta( 'description' ) . '</p>';
 
        // Hiển thị field website của tác giả
        if ( get_the_author_meta( 'user_url' ) ) : printf( __('<a href="%1$s" title="Visit to %2$s website">Visit to my website</a>', 'thachpham'),
                get_the_author_meta( 'user_url' ), get_the_author() );
        endif;
?></div>
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
         <?php// get_sidebar() ?>
     </div>
 </div>
 
 
 <?php
 // lay phan footer
 get_footer();
?>
