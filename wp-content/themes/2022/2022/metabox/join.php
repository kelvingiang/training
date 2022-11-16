<?php

class Admin_Metabox_Join {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        global $post;
        $id = 'join-meta-box';
        $title = '參加活動內容 ';
        $callback = array($this, 'display');
        $screen = array('join'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
        add_meta_box($id, $title, $callback, $screen, 'normal', 'high');
    }

    public function display($post) {
        ?>
        <div style = "height: 50px; margin-top: 25px; margin-right: 10px; text-align: right">
            <a href = "<?php echo home_url('print-single') . '?id=' . $_GET['post']; ?>" target = "_blank" class = "button button-primary button-large" >
                <?php _e(' 列 印 ', '') ?></a>
        </div>
        <div class="content">
            <h3 for="e_eventtitle" class="admin-title" style='float: left ;'  ><?php _e('活動標題 :', 'suite'); ?></h3>
            <label style=' line-height: 3.5; '> <?php echo get_post_meta($post->ID, 'e_eventtitle', true); ?> </label>
        </div>
        <div class="content">
            <h3 for="e_fullname" class="admin-title" style='float: left ;' ><?php _e('登記者姓名 :', 'suite'); ?></h3>
            <label style=' line-height: 3.5; '> <?php echo get_post_meta($post->ID, 'e_fullname', true); ?> </label>
        </div>

        <div class="content">
            <h3 for="e_fullname" class="admin-title" style='float: left ;' ><?php _e('英文姓名 :', 'suite'); ?></h3>
            <label style=' line-height: 3.5; '> <?php echo get_post_meta($post->ID, 'e_enname', true); ?> </label>
        </div>

        <div class="content">
            <h3 for="e_fullname" class="admin-title" style='float: left ;' ><?php _e('電話號碼 :', 'suite'); ?></h3>
            <label style=' line-height: 3.5; '> <?php echo get_post_meta($post->ID, 'e_phone', true); ?> </label>
        </div>

        <div class="content">
            <h3 for="e_fullname" class="admin-title" style='float: left ;' ><?php _e('電郵信箱 :', 'suite'); ?></h3>
            <label style=' line-height: 3.5; '> <?php echo get_post_meta($post->ID, 'e_email', true); ?> </label>
        </div>

        <div class="content">
            <h3 for="e_fullname" class="admin-title" style='float: left ;' ><?php _e('性 別 :', 'suite'); ?></h3>
            <label style=' line-height: 3.5; '> <?php echo get_post_meta($post->ID, 'e_sex', true) == 1 ? '男' : '女'; ?> </label>
        </div>
        <div class="content">
            <h3 for="e_fullname" class="admin-title" style='float: left ;' ><?php _e('個人飲食 :', 'suite'); ?></h3>
            <label style=' line-height: 3.5; '> <?php echo get_post_meta($post->ID, 'e_eat', true) == 1 ? '一般' : '素食'; ?> </label>
        </div>
        <div class="content">
            <h3 for="e_branch" class="admin-title" style='float: left ;' ><?php _e('商會名稱 :', 'suite'); ?></h3>
            <label style=' line-height: 3.5; '> <?php echo get_post_meta($post->ID, 'e_brach', true); ?> </label>
        </div>

        <div class="content">
            <h3 for="e_branch" class="admin-title" style='float: left ;' ><?php _e('職 稱 :', 'suite'); ?></h3>
            <label style=' line-height: 3.5; '> <?php echo get_post_meta($post->ID, 'e_position', true); ?> </label>
        </div>

        <div class="content">
            <h3 for="e_branch" class="admin-title"><?php _e('隨行眷屬 :', 'suite'); ?></h3>
            <label style='margin-left: 30px '> <?php _e('人數 :', 'suite'); ?> <?php echo get_post_meta($post->ID, 'e_count', true); ?> </label> </br>
            <table style=" margin-left: 30px;" id="tb-relation" >
                <thead> 
                    <tr style="height: 30px">
                        <th style=" width: 200px "><?php _e('Full Name Chinses', 'suite'); ?></th> 
                        <th style=" width: 200px "><?php _e('Full Name English', 'suite'); ?></th>  
                        <th style=" width: 100px "><?php _e('關係', 'suite'); ?></th> 
                        <th style=" width: 50px "><?php _e('性別', 'suite'); ?></th> 
                        <th style=" width: 100px "><?php _e('飲食', 'suite'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $name1 = get_post_meta($post->ID, 'e_name_1', true);
                    if ($name1 != '') {
                        ?>
                        <tr> 
                            <td><label> <?php echo get_post_meta($post->ID, 'e_name_1', true); ?> </label></td>
                            <td><label><?php echo get_post_meta($post->ID, 'e_enname_1', true); ?> </label></td>
                            <td><label><?php echo get_post_meta($post->ID, 'e_relation_1', true); ?> </label></td>
                            <td><label><?php echo get_post_meta($post->ID, 'e_sex_1', true) == 1 ? '男' : '女'; ?> </label></td>
                            <td><label> <?php echo get_post_meta($post->ID, 'e_eat_1', true) == 1 ? '一般' : '素食'; ?> </label></td>
                        </tr>
                    <?php } ?>

                    <?php
                    $name2 = get_post_meta($post->ID, 'e_name_2', true);
                    if ($name2 != '') {
                        ?>
                        <tr> 
                            <td><label> <?php echo get_post_meta($post->ID, 'e_name_2', true); ?> </label></td>
                            <td><label> <?php echo get_post_meta($post->ID, 'e_enname_2', true); ?> </label></td>
                            <td><label> <?php echo get_post_meta($post->ID, 'e_relation_2', true); ?> </label></td>
                            <td><label> <?php echo get_post_meta($post->ID, 'e_sex_2', true) == 1 ? '男' : '女'; ?> </label></td>
                            <td><label> <?php echo get_post_meta($post->ID, 'e_eat_2', true) == 1 ? '一般' : '素食'; ?> </label></td>
                        </tr>    
                    <?php } ?>

                    <?php
                    $name3 = get_post_meta($post->ID, 'e_name_3', true);
                    if ($name3 != '') {
                        ?>
                        <tr> 
                            <td><label> <?php echo get_post_meta($post->ID, 'e_name_3', true); ?> </label></td>
                            <td><label> <?php echo get_post_meta($post->ID, 'e_enname_3', true); ?> </label></td>
                            <td><label><?php echo get_post_meta($post->ID, 'e_relation_3', true); ?> </label></td>
                            <td><label> <?php echo get_post_meta($post->ID, 'e_sex_3', true) == 1 ? '男' : '女'; ?> </label></td>
                            <td><label> <?php echo get_post_meta($post->ID, 'e_eat_3', true) == 1 ? '一般' : '素食'; ?> </label></td>
                        </tr>    
                    <?php } ?>

                    <?php
                    $name4 = get_post_meta($post->ID, 'e_name_4', true);
                    if ($name4 != '') {
                        ?>
                        <tr> 
                            <td><label> <?php echo get_post_meta($post->ID, 'e_name_4', true); ?> </label></td>
                            <td><label> <?php echo get_post_meta($post->ID, 'e_enname_4', true); ?> </label></td>
                            <td><label> <?php echo get_post_meta($post->ID, 'e_relation_4', true); ?> </label></td>
                            <td><label> <?php echo get_post_meta($post->ID, 'e_sex_4', true) == 1 ? '男' : '女'; ?> </label></td>
                            <td><label> <?php echo get_post_meta($post->ID, 'e_eat_4', true) == 1 ? '一般' : '素食'; ?> </label></td>
                        </tr>    
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="content">
            <h3 for="e_branch" class="admin-title" ><?php _e('接送方式 : ', 'suite'); ?></h3>
            <div style="margin-left: 30px">
                <?php
                $dontiep = unserialize(get_post_meta($post->ID, 'e_dontiep', TRUE));
                foreach ($dontiep as $key => $value) {
                    ?>
                    <label style=' line-height: 1.5; '> <?php echo $value; ?> </label></br>
                <?php } ?>
            </div>
        </div>

        <div class="content">
            <h3  class="admin-title" ><?php _e('訂房資料: ', 'suite'); ?></h3>
            <div style="margin-left: 30px">
                <?php
                $room = unserialize(get_post_meta($post->ID, 'e_room', TRUE));
                if (count($room) > 1) {
                    ?>
                    <?php _e('入住日期 : ', 'suite'); ?> <label style=' line-height: 1.5; margin-right: 100px'>  <?php echo $room['check_in']; ?> </label> 
                    <?php _e('退房日期 : ', 'suite'); ?> <label style=' line-height: 1.5; '>  <?php echo $room['check_out']; ?> </label></br>
                    <?php _e('單人房 : ', 'suite') ?> <label style=' line-height: 1.5; margin-right: 100px'> <?php echo $room['s_qty']; ?> </label> </br>
                    <?php _e('雙人房: ', 'suite') ?> <label style=' line-height: 1.5; '>   <?php echo $room['b_qty']; ?> </label> 
                    <label style=' line-height: 1.5; margin-left: 15px '>   <?php echo $room['s_bed']; ?> </label>
                    <label style=' line-height: 1.5; margin-left: 15px '>   <?php echo $room['b_bed']; ?> </label>
                    <?php
                } else {
                    echo $room['no_room'];
                }
                ?>
            </div>
        </div>

        <div class="content">
            <h3  class="admin-title" ><?php _e('餐 宴 : ', 'suite'); ?></h3>
            <div style="margin-left: 30px">
                <?php
                $meal = unserialize(get_post_meta($post->ID, 'e_meal', TRUE));
                foreach ($meal as $key => $value) {
                    $arr = explode(',', $value);
                    ?>
                    <label style=' line-height: 1.5; '> <?php echo $arr[0] . ' - ' . $arr[1] . ' : ' . $arr[2]; ?> </label></br>
                <?php } ?>
            </div>
        </div>

        <?php
        $orther = unserialize(get_post_meta($post->ID, 'e_orther', TRUE));
        foreach ($orther as $key => $value) {
            $arr = explode(',', $value);
            ?>
            <div class="content">
                <h3 class="admin-title"><?php echo $arr[0] ?></h3>
                <div style="margin-left: 30px">
                    <label> <?php echo $arr[1] . '  : ' . $arr[2]; ?> </label>
                </div>
            </div>

        <?php } ?>

        <div class="content">
            <h3 class="admin-title"> <?php _e('備註 :', 'suite') ?></h3>
            <div><?php echo get_post_meta($post->ID, 'e_note', true); ?>
            </div>
        </div>
        <?php
    }

    public function save($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (is_admin()) {
            if (@$_POST['post_type'] == 'join') {
                if (isset($_POST['e_meal'])) {
                    update_post_meta($post_id, 'e_meal', $_POST['e_meal']);
                }

                if (isset($_POST['e_room'])) {
                    update_post_meta($post_id, 'e_room', $_POST['e_room']);
                }

                if (isset($_POST['e_count'])) {
                    update_post_meta($post_id, 'e_count', esc_attr($_POST['e_count']));
                }

                if (isset($_POST['e_name_1'])) {
                    update_post_meta($post_id, 'e_name_1', esc_attr($_POST['e_name_1']));
                }

                if (isset($_POST['e_age_1'])) {
                    update_post_meta($post_id, 'e_age_1', esc_attr($_POST['e_age_1']));
                }

                if (isset($_POST['e_name_2'])) {
                    update_post_meta($post_id, 'e_name_2', esc_attr($_POST['e_name_2']));
                }

                if (isset($_POST['e_age_2'])) {
                    update_post_meta($post_id, 'e_age_2', esc_attr($_POST['e_age_2']));
                }
                if (isset($_POST['e_name_3'])) {
                    update_post_meta($post_id, 'e_name_3', esc_attr($_POST['e_name_3']));
                }

                if (isset($_POST['e_age_3'])) {
                    update_post_meta($post_id, 'e_age_3', esc_attr($_POST['e_age_3']));
                }
                if (isset($_POST['e_name_4'])) {
                    update_post_meta($post_id, 'e_name_4', esc_attr($_POST['e_name_4']));
                }

                if (isset($_POST['e_age_4'])) {
                    update_post_meta($post_id, 'e_age_4', esc_attr($_POST['e_age_4']));
                }

                if (isset($_POST['e_note'])) {
                    update_post_meta($post_id, 'e_note', trim(esc_attr($_POST['e_note'])));
                }

                add_action('redirect_post_location', 'custom_redirect');
            }
        }
    }

}
