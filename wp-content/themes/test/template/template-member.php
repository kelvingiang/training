<div class="group-border">
    <div class="group-title"><label><?php _e('Member') ?></label></div>
    <?php  
        require_once(DIR_MODEL . 'admin-model-member-function.php');
        $model = new Admin_Model_Member_Function();
        $cate = get_query_var('category'); // category trùng với tên khai báo trong rewrite.php
        $data = $model->getAllDataByCategory($cate);
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                ?>
                <div class="member-item">
                    <div class="member-head">
                        <div class="member-title">
                            <i><?php echo $val['company_name'] ?></i>
                        </div>
                        <div class="member-icon">
                            <a class="show-icon"><i class="fas fa-chevron-circle-down"></i></a>
                        </div>
                    </div>
                    <div class="member-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                    if(empty($val['img'])) {
                                        $member_img = 'no-image.jpg';
                                    }else {
                                        $member_img = $val['img'];
                                    }
                                ?>
                                <img src="<?php echo PART_IMAGES_MEMBER . $member_img ?>" alt="" class="member-img" />    
                            </div>    
                            <div class="col-lg-12"><label><?php echo _e('Full Name') . ' : ' . $val['contact_name'] ?></label></div>
                            <div class="col-lg-6"><label><?php echo _e('Phone') . ' : ' . $val['phone'] ?></label></div>
                            <div class="col-lg-6"><label><?php echo _e('Cell Phone') . ' : ' . $val['cell_phone'] ?></label></div>
                            <?php 
                                //lay category name cua group
                                global $wpdb; $group_id = $val['group_id'];
                                $table = $wpdb->prefix . 'member_cate';
                                $sql = "SELECT cate_name FROM  $table WHERE type = 1 AND ID = $group_id";
                                $groupName = $wpdb->get_results($sql, ARRAY_A);
                                $group = '';
                                foreach($groupName as $groupN){
                                    $group .= $groupN['cate_name'];
                                }
                            ?>
                            <div class="col-lg-6">
                                <label><?php echo _e('Group') . ' : ' . $group ?></label>
                            </div>
                            <?php 
                                //lay category name cua industry
                                global $wpdb; $industry_id = $val['industry_id'];
                                $table = $wpdb->prefix . 'member_cate';
                                $sql = "SELECT cate_name FROM  $table WHERE type = 2 AND ID = $industry_id";
                                $industryName = $wpdb->get_results($sql, ARRAY_A);
                                $industry = '';
                                foreach($industryName as $industryN){
                                    $industry .= $industryN['cate_name'];
                                }
                            ?>
                            <div class="col-lg-6">
                                <label><?php echo _e('Industries') . ' : ' . $industry ?></label>
                            </div>    
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    ?>  
</div>  
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.member-head').on('click', function() {
            var contentDisplay = jQuery(this).siblings(".member-content").css('display');
            if(contentDisplay == 'none'){
                //dong cac content dang mo
                jQuery(".member-content").css('display', 'none');
                jQuery(this).siblings(".member-content").slideDown('slow');
                jQuery(this).children().children().children('i').removeClass('fas fa-chevron-circle-down');
                jQuery(this).children().children().children('i').addClass('fas fa-chevron-circle-up');  
            } else {
                //hien thi content duoc click
                jQuery(this).siblings(".member-content").slideUp('30');
                jQuery(this).children().children().children('i').removeClass('fas fa-chevron-circle-up');
                jQuery(this).children().children().children('i').addClass('fas fa-chevron-circle-down');
            }
        });
    })
</script>