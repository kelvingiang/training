<?php

class Admin_Controller_Event_Report
{

    private $dependents;
    private $member;
    private $total;
    private $eat1;
    private $eat2;

    public function __construct()
    {
        add_action('admin_menu', array($this, 'create'));
    }

    public function create()
    {
        $menuSlug = 'my-event';
        add_submenu_page('edit.php?post_type=event', "Event Report title", "參加活動名單報表", 'custom_menu_access', $menuSlug, array($this, 'display'));
    }

    public function display()
    {
        $arrEvent = array(
            'post_type' => 'join',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DECS',
        );
        $myQuery = new WP_Query($arrEvent);
        add_action('MY_HOOK_NAME', array($this, 'statistic'));
        do_action('MY_HOOK_NAME');
?>

<h3><?php _e('活動報名詳細資料') ?></h3>
<hr>
<div style=width:800px>
    <?php
            if ($myQuery->have_posts()) :
                while ($myQuery->have_posts()) :
                    $myQuery->the_post();
                    $id = get_the_ID();
                    $meta = get_post_meta($id);
            ?>
    <div style="clear: both">
        <div style="width: 50%; float: left">
            <label class="admin-title"><?php _e('登記者姓名 :', 'suite'); ?></label>
            <label> <?php echo $meta['e_fullname'][0] ?> </label>
        </div>
        <div style="width: 50%; float: left">

        </div>
    </div>
    <div style="clear: both">
        <div style="width: 50%; float: left">
            <label class="admin-title"><?php _e('英文名字 :', 'suite'); ?></label>
            <label> <?php echo $meta['e_enname'][0] ?> </label>
        </div>
        <div style="width: 50%; float: left">
            <label class="admin-title"><?php _e('性別 :', 'suite'); ?></label>
            <label> <?php echo $meta['e_sex'][0] == 1 ? '男' : '女'; ?> </label>
        </div>
    </div>
    <div style="clear: both">
        <div style="width: 50%; float: left">
            <label class="admin-title"><?php _e('電話號碼 :', 'suite'); ?></label>
            <label> <?php echo $meta['e_phone'][0] ?> </label>
        </div>
        <div style="width: 50%; float: left">
            <label class="admin-title"><?php _e('郵電信箱 :', 'suite'); ?></label>
            <label> <?php echo $meta['e_email'][0] ?> </label>
        </div>
    </div>

    <div style="clear: both">
        <div style="width: 50%; float: left">
            <label class="admin-title"><?php _e('商會名稱 :', 'suite'); ?></label>
            <label> <?php echo $meta['e_brach'][0] ?> </label>
        </div>
        <div style="width: 50%; float: left">
            <label class="admin-title"><?php _e('職 稱 :', 'suite'); ?></label>
            <label> <?php echo $meta['e_position'][0] ?> </label>
        </div>
    </div>

    <div style="clear: both">
        <div style="width: 50%; float: left">
            <label class="admin-title"><?php _e('個人飲食 :', 'suite'); ?></label>
            <label> <?php echo $meta['e_eat'][0] == '2' ? ' 素 食  ' : '一 般 ' ?> </label>
        </div>
    </div>
    <!-- ========= NGUOI DI CUNG       -->
    <div style="clear: both">
        <div style="width: 20%; float: left">
            <label class="admin-title"><?php _e('隨行眷屬 :', 'suite'); ?></label>
            <label class="admin-title"><?php _e('人 數 ', 'suite'); ?></label> <label> <?php echo $meta['e_count'][0] ?>
            </label>
        </div>
    </div>
    <?php if ($meta['e_count'][0] > 0) { ?>
    <div style="clear: both">
        <div style="width: 9%; float: left"> &nbsp;
        </div>
        <div style="width: 80%; float: left">
            <div style=" float: left; width: 30%"><label class="admin-title"><?php _e('中文名字 ', 'suite'); ?></label>
            </div>
            <div style=" float: left; width: 40%"><label class="admin-title"><?php _e('英文名字', 'suite'); ?></label>
            </div>
            <div class=" lbl_3"><label class="admin-title"><?php _e('關 係', 'suite'); ?></label> </div>
            <div class="lbl_3"><label class="admin-title"><?php _e('性 別', 'suite'); ?></label> </div>
            <div class=" lbl_3"><label class="admin-title"><?php _e('飲 食', 'suite'); ?></label> </div>
        </div>
    </div>
    <?php } ?>
    <?php if (!empty($meta['e_name_1'][0])) { ?>
    <div style="clear: both">
        <div style="width: 9%; float: left"> &nbsp;
        </div>
        <div style="width: 80%; float: left">
            <div style=" float: left; width: 30%"><label><?php echo $meta['e_name_1'][0] ?></label></div>
            <div style=" float: left; width: 40%"><label><?php echo $meta['e_enname_1'][0] ?></label> </div>
            <div class=" lbl_3"><label><?php echo $meta['e_relation_1'][0] ?></label> </div>
            <div class=" lbl_3"><label><?php echo $meta['e_sex_1'][0] == 1 ? '男' : '女'; ?></label> </div>
            <div class=" lbl_3"><label><?php echo $meta['e_eat_1'][0] == 1 ? '一般' : '素食'; ?></label> </div>
        </div>
    </div>
    <?php } ?>
    <?php if (!empty($meta['e_name_2'][0])) { ?>
    <div style="clear: both">
        <div style="width: 9%; float: left"> &nbsp;
        </div>
        <div style="width: 80%; float: left">
            <div style=" float: left; width: 30%"><label><?php echo $meta['e_name_2'][0] ?></label></div>
            <div style=" float: left; width: 40%"><label><?php echo $meta['e_enname_2'][0] ?></label> </div>
            <div class=" lbl_3"><label><?php echo $meta['e_relation_2'][0] ?></label> </div>
            <div class=" lbl_3"><label><?php echo $meta['e_sex_2'][0] == 1 ? '男' : '女'; ?></label> </div>
            <div class=" lbl_3"><label><?php echo $meta['e_eat_2'][0] == 1 ? '一般' : '素食'; ?></label> </div>
        </div>
    </div>
    <?php } ?>
    <?php if (!empty($meta['e_name_3'][0])) { ?>
    <div style="clear: both">
        <div style="width: 9%; float: left"> &nbsp;
        </div>
        <div style="width: 80%; float: left">
            <div style=" float: left; width: 30%"><label><?php echo $meta['e_name_3'][0] ?></label></div>
            <div style=" float: left; width: 40%"><label><?php echo $meta['e_enname_3'][0] ?></label> </div>
            <div class="lbl_3"><label><?php echo $meta['e_relation_3'][0] ?></label> </div>
            <div class="lbl_3"><label><?php echo $meta['e_sex_3'][0] == 1 ? '男' : '女'; ?></label> </div>
            <div class=" lbl_3"><label><?php echo $meta['e_eat_3'][0] == 1 ? '一般' : '素食'; ?></label> </div>
        </div>
    </div>
    <?php } ?>
    <?php if (!empty($meta['e_name_4'][0])) { ?>
    <div style="clear: both">
        <div style="width: 9%; float: left"> &nbsp;
        </div>
        <div style="width: 80%; float: left">
            <div style=" float: left; width: 30%"><label><?php echo $meta['e_name_4'][0] ?></label></div>
            <div style=" float: left; width: 40%"><label><?php echo $meta['e_enname_4'][0] ?></label> </div>
            <div class=" lbl_3"><label><?php echo $meta['e_relation_4'][0] ?></label> </div>
            <div class=" lbl_3"><label><?php echo $meta['e_sex_4'][0] == 1 ? '男' : '女'; ?></label> </div>
            <div class=" lbl_3"><label><?php echo $meta['e_eat_4'][0] == 1 ? '一般' : '素食'; ?></label> </div>
        </div>
    </div>
    <?php } ?>
    <!-- ==========CACH THUC DON TIEP -->
    <?php $dontiep = unserialize(get_post_meta($id, 'e_dontiep', TRUE)) ?>
    <div style="clear: both">
        <div style="width: 9%; float: left">
            <label class="admin-title"><?php _e('接送方式 :', 'suite'); ?></label>
        </div>
    </div>
    <div style="width: 80%; float: left">
        <?php foreach ($dontiep as $key => $value) { ?>
        <label style=' line-height: 1.5; '> <?php echo $value; ?> </label></br>
        <?php } ?>
    </div>
    <!-- ====== DAT PHONG NGU ======-->
    <?php $room = unserialize(get_post_meta($id, 'e_room', TRUE)) ?>
    <div style="clear: both">
        <div style="width: 9%; float: left">
            <label class="admin-title"><?php _e('訂房資料 :', 'suite'); ?></label>
        </div>
    </div>
    <div style="width: 80%; float: left">
        <?php if (isset($room['no_room'])) { ?>
        <label style=' line-height: 1.5; '> <?php echo $room['no_room']; ?> </label></br>
        <?php } else { ?>
        <label
            class="admin-title"><?php _e('入住日期 :', 'suite'); ?></label><label><?php echo $room['check_in'] . ' &nbsp; &nbsp;-- &nbsp; &nbsp;'; ?></label>
        <label
            class="admin-title"><?php _e('退房日期 :', 'suite'); ?></label><label><?php echo $room['check_out']; ?></label></br>
        <?php //if(isset($room['s_room'])) {  
                            ?>
        <label><?php echo '單人房  &nbsp; : &nbsp;' . $room['s_qty']; ?></label> </br>
        <?php //} if(isset($room['b_room'])){  
                            ?>
        <label><?php echo ' 雙人房 &nbsp; : &nbsp;' . $room['b_qty'] . ',&nbsp; &nbsp;'; ?></label>
        <label><?php echo $room['s_bed'] . '&nbsp; &nbsp;' . $room['b_bed']; ?> </label> </br>
        <?php //}  
                            ?>
        <?php } ?>
    </div>
    <!-- DUNG BUA -->
    <?php $meal = unserialize(get_post_meta($id, 'e_meal', TRUE)); ?>
    <div style="clear: both">
        <div style="width: 9%; float: left">
            <label class="admin-title"><?php _e('餐宴 :', 'suite'); ?></label>
        </div>
    </div>
    <div style="width: 80%; float: left">
        <?php
                        foreach ($meal as $key => $value) {
                            $arr = explode(',', $value)
                        ?>
        <label style=' line-height: 1.5; '> <?php echo $arr[0] . ' - ' . $arr[1] . ' : ' . $arr[2]; ?> </label></br>
        <?php } ?>
    </div>
    <!-- CAC THANH PHAN ADD THEM  KHAC -->
    <?php
                    $orther = unserialize(get_post_meta($id, 'e_orther', true));
                    if (!empty($orther)) {
                        foreach ($orther as $value) {
                            $arr = explode(',', $value);
                    ?>
    <div style="clear: both;  width: 98%">
        <div>
            <label class="admin-title"><?php echo $arr[0]; ?></label>
        </div>
    </div>
    <div>
        <label><?php echo $arr[1] . '  :  ' . $arr[2]; ?></label>
    </div>
    <?php
                        }
                    }
                    ?>
    <!--  GHI CHU -->
    <div style="clear: both;  margin-top: 10px;">
        <div style="width: 9%; float: left">
            <label class="admin-title"><?php _e('備註 :', 'suite'); ?></label>
        </div>
    </div>
    <div style="width: 80%; float: left">
        <label style=' line-height: 1.5; '> <?php echo $meta['e_note'][0] ?> </label></br>
    </div>

    <div style=" height: 1px; margin-top:35px;  margin-bottom: 15px; background-color: #999999" class="clear"></div>
    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
</div>

<?php
    }

    public function statistic()
    {
        $mealArray = array();
        $roomArray = array();
        $ortherArray = array();

        $arrEvent = array(
            'post_type' => 'join',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DECS',
        );
        $myQuery = new WP_Query($arrEvent);
        if ($myQuery->have_posts()) :
            while ($myQuery->have_posts()) :
                $myQuery->the_post();
                $id = get_the_ID();
                $meta = get_post_meta($id);
                /* SO NGUOI THAM GIA */
                $this->dependents += (int) $meta['e_count'][0];
                $this->member++;
                $this->total = $this->dependents + $this->member;
                /*  AN UONG  */
                if ($meta['e_eat'][0] == '1') {
                    $this->eat1++;
                } elseif ($meta['e_eat'][0] == '2') {
                    $this->eat2++;
                }
                if ($meta['e_eat_1'][0] == '1') {
                    $this->eat1++;
                } elseif ($meta['e_eat_1'][0] == '2') {
                    $this->eat2++;
                }
                if ($meta['e_eat_2'][0] == '1') {
                    $this->eat1++;
                } elseif ($meta['e_eat_2'][0] == '2') {
                    $this->eat2++;
                }
                if ($meta['e_eat_3'][0] == '1') {
                    $this->eat1++;
                } elseif ($meta['e_eat_3'][0] == '2') {
                    $this->eat2++;
                }
                if ($meta['e_eat_4'][0] == '1') {
                    $this->eat1++;
                } elseif ($meta['e_eat_4'][0] == '2') {
                    $this->eat2++;
                }

                /*  THAM GIA DUNG BUA */
                $meal = unserialize(get_post_meta($id, 'e_meal', TRUE));
                if (!empty($meal)) {
                    foreach ($meal as $key => $value) {
                        $mealData = explode(',', $value);
                        $mealArray[] = array('name' => $mealData[0], 'count' => (int) $mealData[2]);
                    }
                }

                /* CAC THANH PHAN THEM MOI KHAC */
                $orther = unserialize(get_post_meta($id, 'e_orther', TRUE));
                if (!empty($orther)) {
                    foreach ($orther as $value) {
                        $ortherData = explode(',', $value);
                        $ortherArray[] = array('title' => $ortherData[0], 'count' => (int) $ortherData[2]);
                    }
                }
                /* DAT PHONG   */
                $room = unserialize(get_post_meta($id, 'e_room', TRUE));
                if (!empty($room)) {
                    $roomArray[] = $room;
                }
            endwhile;
        endif;

        /*   LAY TAT CA VA GROUP CAC TEN TRUNG CHI LAY 1; */
        $arrGroup = array();
        if (!empty($mealArray)) {
            foreach ($mealArray as $key => $value) {
                $arrGroup[$value['name']] = 1;
            }
        }

        $arrGruopOrther = array();
        if (!empty($ortherArray)) {
            foreach ($ortherArray as $key => $value) {
                $arrGruopOrther[$value['title']] = 1;
            }
        }


        /* LAY SO LUONG NGUOI THAM GIA DE THONG KE TOTAL */
        $arrTotal = array();
        if (!empty($arrGroup)) {
            foreach ($arrGroup as $key => $value) {
                $dd = '';
                foreach ($mealArray as $value2) {
                    if ($key == $value2['name']) {
                        $dd[] = $value2['count'];
                    }
                }
                $arrTotal[] = array($key, $dd);
            }
        }

        $arrOrtherTotal = array();
        if (!empty($arrGruopOrther)) {
            foreach ($arrGruopOrther as $key => $value) {
                $or = '';
                foreach ($ortherArray as $value2) {
                    if ($key == $value2['title']) {
                        $or[] = $value2['count'];
                    }
                }
                $arrOrtherTotal[] = array($key, $or);
            }
        }

        /* SO LUONG VA LOAI PHONG DUOC DAT */
        $arrRoom = array();
        $arrRoom[] = $roomArray[1]['b_room'];
        $arrRoom[] = $roomArray[1]['s_room'];
        foreach ($roomArray as $value) {
            $b_qty[] = $value['b_qty'];
            $s_qty[] = $value['s_qty'];
        }
        $arrRoom[] = $b_qty;
        $arrRoom[] = $s_qty;

        /* THONG KE SO LUONG ADD THEM MOI */
    ?>
<div style="height: 50px; margin-top: 25px; margin-left: 10px">
    <a href="<?php echo home_url('print-report'); ?>" target="_blank" class="button button-primary button-large">
        <?php _e(' 列印所有資料', '') ?></a>
    <a href="<?php echo home_url('print-total'); ?>" target="_blank" class="button button-primary button-large">
        <?php _e(' 列印總計數據', '') ?></a>
</div>
<?php
        echo '<div style=" background-color : #FCF9E3; font-weight: bold; font-size: 13px; line-height:1.4;padding: 10px; color: back">';
        echo '<h3>總計數據</h3>';
        echo '<div><label> 參加總人數  =  ' . $this->total . ' 位 </label></div>';
        echo '<div><label> 飲食(一般)  =  ' . $this->eat1 . ' 位  </label></div>';
        echo '<div><label> 飲食(素養)  =  ' . $this->eat2 . ' 位 </label></div>';
        /*  SHOW THAM GIA DUNG BUA */

        if (!empty($arrTotal)) {
            foreach ($arrTotal as $value) {
                echo $value[0] . ' = ';
                echo array_sum($value[1]);
                echo ' 位 <br>';
            }
        }
        /* SHOW LOAI VA SO PHONG PHAI DAT  */
        if (!empty($arrRoom)) {
            echo '單人房' . ' = ' . array_sum($arrRoom[2]) . ' 間<br>';
            echo '雙人房' . ' = ' . array_sum($arrRoom[3]) . ' 間<br>';
        }

        /* ORTHER THONG KE CAC PHAN ADD THEM */
        if (!empty($arrOrtherTotal)) {
            foreach ($arrOrtherTotal as $value) {
                echo $value[0] . '  = ';
                echo array_sum($value[1]);
                echo ' 位 <br>';
            }
        }
        echo '</div>';
    }
}