<?php
// lay phan header
get_header();
wp_link_pages(); // HIEN THI PHAN TRANG BAI VIET KHI TRONG BAI CO CHEN <!--nextpage--> TRONG PHAN text
// moi mot <!--nextpage--> se chia thanh  1 trang
// $category = get_the_category(); echo $category[0]->name;
// 022416
if (get_query_var('cate')) {
    $_SESSION['cate'] = get_query_var('cate');
}


$arrname = array(
    'post_type' => 'forum',
    'forum_category' => $_SESSION['cate'],
);
$myQueryname = new WP_Query($arrname);
if ($myQueryname->have_posts()):
    while ($myQueryname->have_posts()):
        $myQueryname->the_post();
        //LAY CATEGORY CUA CUSTOMPOST
        $idname = get_the_ID();
        $termname = wp_get_post_terms($idname, 'forum_category');
        if (count($termname) > 0) {
            $slugname = $termname[0]->slug;
            $namename = $termname[0]->name;
        }
    endwhile;
endif;
?>
<!-- phan noi dung of trang index --------------------------------------- -->
<div class="row">
    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-12">
        <div>
            <ul>
                <li class='back-link'><a href='<?php echo home_url('the-forum'); ?>'>留言區</a></li>
                <li class='back-link'><a href="<?php echo home_url('forum-cate') . '/p/0/' . $slugname; ?>"> <?php echo $namename; ?></a>  </li>
                <li></li>
            </ul>
        </div>
        <div style='clear: both'></div>
        <!-- lay cac bai post  -->
        <?php
        //===== ARTICLE INFOMATION ====================================================
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                $meta = get_post_meta($post->ID);
                $view = (int) $meta['f_view'][0];
                $like = $meta['f_like'][0];

                if (!isset($_SESSION['time'])) {
                    $_SESSION['time'] = time();
                    update_post_meta($post->ID, 'f_view', $view + 1);
                } elseif ((time() - $_SESSION['time']) >= 20) {
                    unset($_SESSION['time']);
                    update_post_meta($post->ID, 'f_view', $view + 1);
                }

                /*
                  unset($_SESSION['view']);
                  echo '1-' . $_SESSION['view'] . ' - ' . $post->ID . ' <br>';
                  if (!isset($_SESSION['view']) or $_SESSION['view'] !== $post->ID) {

                  $_SESSION['view'] = $post->ID;
                  echo '2-' . $_SESSION['view'] . ' - ' . $post->ID . ' <br>';
                  }
                  if($flag == $post->ID or $_SESSION['view'] == $post->ID){
                  $_SESSION['view'] = $post->ID;
                  update_post_meta($post->ID, 'f_view', $view + 1);
                  echo '3-' . $_SESSION['view'] . ' - ' . $post->ID . ' <br>';
                  }
                 */

                //==== phan lay author
                $article_author = $post->post_author; // LAY ID AUTHOR DE LAY TEN AUTHOR TRONG MEMBER 
                //   $getauthor = get_the_author(); // LAY AUTHOR TRONG ADMIN
                //  echo $getauthor.'dsfsdfs';
                //  if (!empty($getauthor)) {
                //  $author = $getauthor; // NEU AUTHOR TRONG CO SE SU DUNG CUA ADMIN
                //  } else {
                // NGUOC LAI THONG QUA post_author QUA POST_TYPE = member DE LAY TEN USER OF ARTICLE 
                $arr = array(
                    'post_type' => 'member',
                    'name' => $article_author,
                );
                $arrMember = get_posts($arr);
                $meta = get_post_meta($arrMember[0]->ID);
                $author = $meta['m_user'][0];

                $post_au = $meta['m_fullname'][0] . ' ( ' . $meta['m_user'][0] . ' ) ';
                ?>
                <div class="orange-group">
                    <div class="orange-title">
                        <label><?php the_title(); ?></label> 
                    </div>
                    <div  class="info-bg">

                        <?php $dd = $post->ID;  // tao bien de chuyen qua ajax ?>
                        <div class="row" style="margin-top: 0px">
                            <div class=" col-md-6">
                                <h4 class="small" > 
                                    <?php _e('發表者 : ', 'suite'); ?><b style=" color: #286090"><?php echo $author != NULL ? $post_au : 'Admin'; ?> </b></br>
                                    <?php _e('在 :', 'suite'); ?> <?php echo $post->post_date; ?> <?php _e('發表', 'suite'); ?></h4>

                            </div>
                            <div class=" col-md-6" style ="text-align: right">
                                <lable id="like" style="cursor: pointer; font-weight: bold; color: #286090" ><?php _e('讚賞 : ', 'suite'); ?></lable><lable id="likeResult"><?php echo $like ?> </lable> |
                                <lable><b><?php _e('瀏覽 : ', 'suite'); ?></b>  <?php echo $view + 1 ?></lable> |
                                <lable><b><?php _e(' 評 論 : ', 'suite'); ?></b> <?php comments_number('0', '1', '%'); ?></lable>
                            </div>
                            <?php ?>
                        </div>
                        <div style=" margin-bottom: 30px"><?php echo $post->post_content // NOI DUNG                            ?></div>      
                    </div>
                    <hr>
                    <?php
                    comments_template();
                endwhile;

            endif;
            ?>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
        <?php get_sidebar('forum') ?>
    </div>
    <?php
//    echo '<pre>';
//    print_r($wp);
//    echo '</pre>';
    ?>
</div>
<script type="text/javascript">

    jQuery(document).ready(function () {
        // ajax like 

        jQuery('#like').click(function (e) {
            jQuery.ajax({
                url: ' <?php echo get_template_directory_uri() . '/ajax/like.php' ?>', // lay doi tuong chuyen sang dang array
                type: "post",
                data: {id: <?php echo $dd ?>},
                dataType: 'json',
                cache: false,
                //  contentType: false, // TAT DI 2 PHAN NAY GIA TRI POST MOI CHUYEN DI DC
                //  processData: false,
                success: function (data) {  // set ket qua tra ve  data tra ve co thanh phan status va message
                    if (data.status === 'done') {
                        //    console.log(data);
                        $('#likeResult').text(data.like);
                        //  location.reload();
                    } else if (data.status === 'error') {
                        $('#mess').text(data.message);
                    }
                },
                error: function (xhr) {
                    console.log(xhr.reponseText);
                }
            });
            e.preventDefault();
        });




        $('.item .delete').click(function () {
            var elem = $(this).closest('.item');
            $.confirm({
                'title': 'Delete Confirmation',
                'message': 'You are about to delete this item. <br />It cannot be restored at a later time! Continue?',
                'buttons': {
                    'Yes': {
                        'class': 'blue',
                        'action': function () {
                            elem.slideUp();
                        }
                    },
                    'No': {
                        'class': 'gray',
                        'action': function () {
                        }	// Nothing to do in this case. You can as well omit the action property.
                    }
                }
            });
        });
    });
</script>

<?php
// lay phan footer
get_footer();
