<?php
/*
  Template Name:  Member
 */
?>
<?php get_header(); ?>

<div class="row" style="padding-top: 30px" >
    <div class="first-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <?php get_sidebar(); ?>
    </div>
    <div class="second-space col-lg-9 col-md-8 col-sm-12 col-xs-12">
        <div class="group-border">
            <div class="group-title">
                <label><?php _e('Member List'); ?></label>
            </div>
            <?php
            global $wpdb;
            $table = $wpdb->prefix . 'member';
            $table_industry = $wpdb->prefix . 'member_industry';
            $industry = urldecode(get_query_var('industry')); // GET PARAMS AND GIAI MA TREN GIA TRI LAY VE TU URL
            $region = urldecode(get_query_var('region')); // GET PARAMS AND GIAI MA TREN GIA TRI LAY VE TU URL

            if (!empty($industry)) {
                $sql = "SELECT * FROM $table WHERE industry_id LIKE '%,$industry,%' ORDER BY `order` DESC ";
                $flag = false;
            } elseif (!empty($region)) {
                $sql = "SELECT * FROM $table WHERE region = '$region'";
                $flag = false;
            } else {
                $flag = true;
                $page = get_query_var('page');
                if (empty($page)) {
                    $page = 1;
                }
                $limit = 20;
                $offset = ($page - 1) * $limit;

                $result = "SELECT  ID  FROM $table ";
                $wpdb->get_results($result, ARRAY_A);
                $total_record = $wpdb->num_rows; // TONG SO DONG RECODE
                $total_page = ceil($total_record / $limit);  // TONG SO TRANG DUOC CHIA

                $sql = "SELECT * FROM $table ORDER BY `order` DESC LIMIT $offset , $limit";
            }
            $memberList = $wpdb->get_results($sql, ARRAY_A);
            ?>
            <div>
                <?php
                if (!empty($memberList)) {
                    foreach ($memberList as $val) {
                        ?>
                        <div style='width: 100%'>
                            <div class='member-list'>
                                <div class='member-title'><i style="color: #999; margin-right: 10px"> <?php echo $val['serial'] . ' </i> ' . $val['company_cn'] ?></div> 
                                <div class='member-icon'><a class='show-icon' style='font-weight: bold; cursor:  pointer'><i class="fa fa-angle-double-down"></i></a>></div>
                            </div>
                            <div class='member-content'>
                                <div class="row" style="padding: 10px; color: #666;">
                                    <div class="col-lg-12"><label><?php echo $val['company_vn'] ?></label></div>
                                    <div class="col-lg-12"><label><?php echo $val['address_cn'] ?></label></div>
                                    <div class="col-lg-12"><label><?php echo $val['address_vn'] ?></label></div>
                                    <div class="col-lg-6"><label><?php echo __('Full Name') . ' : ' . $val['contact'] ?></label></div>
                                    <div class="col-lg-6"><label><?php echo __('Regency') . ' : ' . $val['position'] ?></label></div>
                                    <div class="col-lg-6"><label><?php echo __('Phone') . ' : ' . $val['phone'] ?></label></div>
                                    <div class="col-lg-6"><label><?php echo __('Email') . ' : ' . $val['email'] ?></label></div>
                                    <div class="col-lg-12"><label><?php echo __('Service List') . ' : ' . $val['service'] ?></label></div>

                                    <div class="col-lg-12">
                                        <?php
                                        $result2 = "SELECT  name  FROM $table_industry WHERE ID IN (" . substr($val['industry_id'], 1, -1) . ")";
                                        $industryListName = $wpdb->get_results($result2, ARRAY_A);
                                        $stt = 1;
                                        $dd = '';
                                        foreach ($industryListName as $val) {
                                            $dd .= $val['name'];
                                            if (count($industryListName) > $stt) {
                                                $dd .= ', &nbsp; ';
                                            }
                                            $stt++;
                                        }
                                        ?>
                                        <label><?php echo __('Industry') . ' : ' . $dd ?></label>
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
            <?php if ($flag == true) { ?>
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
                        'link_first' => home_url('member'), // Link trang đầu tiên
                        'range' => 5// Số button trang bạn muốn hiển thị 
                    );
                    require_once (DIR_CLASS . 'pagination.php');
                    $paging = new Pagination();
                    $paging->init($config);
                    echo $paging->html();
                    ?>
                </div>
            <?php } ?>            
        </div>
        <div><?php get_template_part('component/template', 'multi-silder') ?></div>
    </div>
    <div class="last-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <?php get_sidebar('mobile'); ?>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.member-list').click(function () {
            var contentDisplay = jQuery(this).siblings(".member-content").css('display');
            if (contentDisplay === 'none') {
                jQuery(this).siblings(".member-content").slideDown('slow');
                jQuery(this).children().children().children('i').removeClass('fa-angle-double-down');
                jQuery(this).children().children().children('i').addClass('fa-angle-double-up');
            } else {
                jQuery(this).siblings(".member-content").slideUp('30');
                jQuery(this).children().children().children('i').removeClass('fa-angle-double-up');
                jQuery(this).children().children().children('i').addClass('fa-angle-double-down');
            }
        });
    });
</script>
<?php get_footer(); ?>