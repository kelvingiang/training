<?php
/*
  Template Name:  Schedule
 */
?>
<?php get_header(); ?>
<style>
    .schedule_item{
        border-bottom: 1px solid  #e9edf9;
        padding: 10px;
        font-size: 14px;
    }
    .schedule_item:nth-child(even){
        background-color:#f5f7fd;
    }
    .schedule_title{
    }
    .schedule_title_text{
        font-size: 16px;
        font-weight: bold;
        padding: 0px 10px;
        color:  #0145A9;
        width: 100%;
        height: 40px;
        line-height: 40px;
        cursor:  pointer;
        display:  block;
    }
    .schedule_title_text div:first-child{
        float: left;
    }
    .schedule_title_text div:last-child {
        float: right;
    }
    .schedule_title_time{
        clear: both;
    }
    .schedule_content{
      display: none;
      margin-top: 6px;
      font-size: 14px
    }
</style>
<div class="row" style="padding-top: 30px" >
    <div class="first-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <?php get_sidebar(); ?>
    </div>
    <div class="second-space col-lg-9 col-md-8 col-sm-12 col-xs-12">
        <div class="group-border">
            <div class="group-title">
                <label><?php _e('Schedule List'); ?></label>
            </div>
            <?php
            global $wpdb;
            $table = $wpdb->prefix . 'schedule';
            $limit = 100;
            $offset = ($page - 1) * $limit;

            $result = "SELECT ID FROM $table ";
            $wpdb->get_results($result, ARRAY_A);
            $total_record = $wpdb->num_rows; // TONG SO DONG RECODE
            $total_page = ceil($total_record / $limit);  // TONG SO TRANG DUOC CHIA
            $sql = "SELECT * FROM $table WHERE trash = 1  ORDER BY year  DESC, month  DESC, day DESC LIMIT $offset , $limit";


            $memberList = $wpdb->get_results($sql, ARRAY_A);
            ?>
            <div>
                <?php
                if (!empty($memberList)) {
                    foreach ($memberList as $val) {
                        ?>
                        <div class="schedule_item">
                            <div class="schedule_title">
                                <div class="schedule_title_text">
                                    <div><?php echo $val['title'] ?></div>
                                    <div><i class="fa fa-angle-double-down"></i></div>
                                </div> 
                                <div class="schedule_title_time">
                                    <?php echo $val['weekdays'] . '  ' . $val['day'] . '-' . $val['month'] . '-' . $val['year'] ?> 
                                    &nbsp;&nbsp;
                                    <?php echo __('Time') . ' : ' . $val['start_time'] . ' -- ' . $val['end_time'] ?>
                                </div> 
                            </div>
                            <div class="schedule_content">
                                <div><label><b><?php _e('Place') ?> :</b> </label> <?php echo $val['place'] ?></div>
                                <div><label><b><?php _e('Note') ?> : </b></label> <?php echo $val['note'] ?></div>
                            </div>   
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="pagin-speac">
                <?php
                if (empty(get_query_var('page'))) {
                    $current = 1;
                } else {
                    $current = get_query_var('page');
                }
                $config = array(
                    'current_page' => $current, // Trang hiện tại
                    'total_record' => $total_record, // Tổng số record
                    'limit' => $limit, // limit
                    'link_full' => 'index.php?page={page}', // Link full có dạng như sau: domain/com/page/{page}
                    'link_first' => home_url('schedule'), // Link trang đầu tiên
                    'range' => 5// Số button trang bạn muốn hiển thị 
                );
                require_once (DIR_CLASS . 'pagination.php');
                $paging = new Pagination();
                $paging->init($config);
                echo $paging->html();
                ?>
            </div>
        </div>
    </div>
    <div class="last-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <?php get_sidebar('mobile'); ?>
    </div>
</div>


<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.schedule_title_text').click(function () {
            var contentDisplay = jQuery(this).parent().next(".schedule_content").css('display');
            console.log(contentDisplay);
            if (contentDisplay === 'none') {
                jQuery(this).parent().next(".schedule_content").slideDown('slow');
                jQuery(this).children('div').children('i').removeClass('fa-angle-double-down');
                jQuery(this).children('div').children('i').addClass('fa-angle-double-up');
            } else {
                jQuery(this).parent().next(".schedule_content").slideUp('80')
                jQuery(this).children('div').children('i').removeClass('fa-angle-double-up');
                jQuery(this).children('div').children('i').addClass('fa-angle-double-down');
            }
        });
    });
</script>
<?php get_footer();