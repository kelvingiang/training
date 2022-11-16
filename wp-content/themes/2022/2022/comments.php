<?php
// get data of user dang nhap 
// dieu kien get data tu metabox == where
$arrArgs = array(
    'post_type' => 'member',
    'meta_query' => array(
        array('key' => 'm_user', 'value' => $_SESSION['login']),
    )
);
// KIEM TRA DU LIEU CO TRUNG HAY KHONG
$objMember = current(get_posts($arrArgs));
$getMeta = get_post_meta($objMember->ID); // lay gia tri tu metabox 
$member_ID = $objMember->ID;
$member_name = $getMeta['m_user'][0];
$member_email = $getMeta['m_email'][0];


// phan comment
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die('Please do not load this page directly. Thanks!');

if (post_password_required()) {
    ?>
    This post is password protected. Enter the password to view comments.
    <?php
    return;
}
?>
<?php if (!isset($_SESSION['login'])) { ?>
    <style type="text/css">
        p.reply{display: none}
    </style>
<?php } ?>


<?php if (have_comments()) : ?>
    <div class=" blue-group ">
        <div class="blue-title">
            <label>
                <?php comments_number('沒有評論', '有一個評論', '有 % 個評論'); ?>
            </label>
            <div class="navigation">
                <div class="top-navigation" ><?php previous_comments_link() ?> &nbsp;  &nbsp; &nbsp; <?php next_comments_link() ?></div>
            </div>

        </div>
      <!--  <h2 id="comments"><?php // comments_number('No Comment', 'One Comment', '% Responses');   ?></h2> -->

        <ul class="commentlist">
            <?php
            //    wp_list_comments(); // cai defualt 
            // CALLBACK GOI DEN FUNCTION HIEN THI PHAN ITEM CUA COMMEMT
            wp_list_comments('type=comment&callback=suite_comment');
            ?>
        </ul>
    </div>
    <hr>

    <div class="navigation">
        <div class="bottom-navigation"><?php previous_comments_link() ?>&nbsp;  &nbsp; &nbsp;<?php next_comments_link() ?></div>
    </div>

    <div style=" clear: both"></div>
<?php else : // this is displayed if there are no comments so far  ?>

    <?php if (comments_open()) : ?>
        <!-- If comments are open, but there are no comments. -->

    <?php else : // comments are closed  ?>
        <p>Comments are closed.</p>

    <?php endif; ?>

<?php endif; ?>

<?php
?>

<!--  phan input submit comment -->      
<?php if (isset($_SESSION['login'])) { ?>       
    <?php if (comments_open()) : ?>
        <hr>
        <div id="respond">

                           <!-- <h2><?php // comment_form_title('發表評論', '向 %s 回覆 ');   ?></h2>-->
            <h2 id="comments" style=" font-size: 20px; font-weight: bold; color: #4C7BA3;  padding-top: 9px; padding-left: 15px">
                <?php comment_form_title('發表評論', '發表回覆 '); ?>
            </h2>

            <div class="cancel-comment-reply">
                <?php cancel_comment_reply_link(); ?>
            </div>

            <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <!--  <p>You must be <a href="<?php // echo wp_login_url(get_permalink());                                            ?>">logged in</a> to post a comment.</p>-->
            <?php else : ?>

                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

                    <?php if (is_user_logged_in()) : ?>
                        <!-- an di phan thong bao login khi comment
                                            <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php // echo $user_identity;                                             ?></a>. <a href="<?php // echo wp_logout_url(get_permalink());                                             ?>" title="Log out of this account">Log out &raquo;</a></p>
                        -->
                    <?php else : ?>

                        <div>
                            <input type="hidden"  name="author" id="author" value="<?php echo $member_name ?>"  tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                        </div>
                        <div style="clear: both"> </div>

                        <div>
                            <input type="hidden" name="email" id="email" value="<?php echo $member_email ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                        </div>
                        <div style="clear: both"> </div>
                        <input type="hidden" name="user" id="user" value="<?php echo $member_ID; ?>" size="22" tabindex="3" /> 
                    <?php endif; ?>
            <!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->
                    <div>
                        <textarea name="comment" placeholder="" id="comment" cols="90" rows="10" tabindex="4"></textarea>
                        <label style="height: 25px; color: red">  </label>
                    </div>
                    <div class="cmt-send" style="text-align: right; margin: 20px">
                        <input  name="cmt-submit" type="submit" id="cmt-submit" class="btn btn-primary" tabindex="5" value=" 回 響 " />
                        <?php comment_id_fields(); ?>
                    </div>

                    <?php do_action('comment_form', $post->ID); ?>
                </form>

            <?php endif; // If registration required and not logged in  ?>
        </div>
    <?php endif; ?>
<?php } ?>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#cmt-submit').click(function (event) {
            var cmtdata = $('#comment').val();
            var cmtlen = cmtdata.length;
            //var myPattern = new RegExp(/(sex|yeu)/g);
            //  var ss = cmtdata.match(myPattern);
            // alert(ss);
            if (cmtlen < 1) {
                $('#comment').next().text('Please Required Content');
                event.preventDefault();
                return false;
            } else {
                $('#comment').next().text('');
            }

            if (cmtdata !== null) {
                // kiem tra bang a ajax
                jQuery.ajax({
                    url: '<?php echo get_template_directory_uri() . '/ajax/checkword.php' ?>', //objInfo.url,  
                    type: 'post',
                    data: {comment: cmtdata},
                    dataType: 'json',
                    cache: false,
                    success: function (data) {  // set ket qua tra ve  data tra ve co thanh phan status va message
                        if (data.status === 'empty') {
                            $('#comment').next().text(data.mess);
                            event.preventDefault();
                        } else if (data.status === 'error') {
                            $('#comment').next().text(data.mess);
                            event.preventDefault();
                        } else {
                            $('#comment').next().text('');
                            $('#commentform').submit();
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.reponseText);

                    }

                });
                event.preventDefault();
            }

        });

    });
</script>
