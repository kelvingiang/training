<?php

class Admin_Metabox_Apply {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        global $post;
        $id = 'friend-meta-box';
        $title = '活動報名資料設定';
        $callback = array($this, 'display');
        $screen = array('apply'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
        add_meta_box($id, $title, $callback, $screen, 'normal', 'high');
    }

    public function display($post) {
        //THIET LAP EDITOR
        $editor_settings = array(
            'wpautop' => false,
            'editor_height' => '150px'
        );
        ?>
        <div class="content">
            <h3 class='admin-title' ><?php _e('接送方式', 'suite'); ?></h3>
            <label for="a_dontiep_1" class="label-admin" style=" margin-left: 20px " ><?php _e('方式一', 'suite'); ?></label>
            <input type="text" name="a_dontiep_1"  id="a_dontiep_1" value="<?php echo get_post_meta($post->ID, 'a_dontiep_1', true); ?>" /></br>
            <label for="a_dontiep_2" class="label-admin" style="margin-left: 20px " ><?php _e('方式二', 'suite'); ?></label> 
            <input type="text" name="a_dontiep_2"  id="a_dontiep_2" value="<?php echo get_post_meta($post->ID, 'a_dontiep_2', true); ?>" /></br>
            <label for="a_dontiep_3" class="label-admin" style="margin-left: 20px " ><?php _e('方式三', 'suite'); ?></label> 
            <input type="text" name="a_dontiep_3"  id="a_dontiep_3" value="<?php echo get_post_meta($post->ID, 'a_dontiep_3', true); ?>" /></br>
            <label for="a_dontiep_4" class="label-admin" style="margin-left: 20px " ><?php _e('方式四', 'suite'); ?></label>
            <input type="text" name="a_dontiep_4"  id="a_dontiep_4" value="<?php echo get_post_meta($post->ID, 'a_dontiep_4', true); ?>" /></br>
            <label for="a_dontiep_5" class="label-admin" style="margin-left: 20px " ><?php _e('方式五', 'suite'); ?></label> 
            <input type="text" name="a_dontiep_5"  id="a_dontiep_5" value="<?php echo get_post_meta($post->ID, 'a_dontiep_5', true); ?>" /></br>
        </div>
        <hr/>
        <div class="content">
            <h3 class='admin-title' ><?php _e('出席費', 'suite'); ?></h3>
            <?php wp_editor(get_post_meta($post->ID, 'a_attend', true), 'a_attend', $editor_settings); ?>
        </div>
        <hr/>
        <div class="content">
            <h3 class='admin-title' ><?php _e('訂房資料', 'suite'); ?></h3>
            <label for="a_hotel" class="label-admin" style="margin-left: 20px " ><?php _e('旅店名稱', 'suite'); ?></label> 
            <input type="text" name="a_hotel"  id="a_hotel" value="<?php echo get_post_meta($post->ID, 'a_hotel', true); ?>" /></br>
            <label for="a_room_fee" class="label-admin" style="margin-left: 20px " ><?php _e('房子價格', 'suite'); ?></label> 
            <input type="text" name="a_room_fee"  id="a_room_fee"   value="<?php echo get_post_meta($post->ID, 'a_room_fee', true); ?>" /></br>
            <label for="a_room_note" class="label-admin" style="margin-left: 20px " ><?php _e('備註欄', 'suite'); ?></label> 
            <input type="text" name="a_room_note"  id="a_room_note"   value="<?php echo get_post_meta($post->ID, 'a_room_note', true); ?>" /></br>
        </div>
        <hr/>
        <div class="content">
            <h3 class='admin-title' ><?php _e('餐宴', 'suite'); ?></h3>
            <label for="a_meal_1" class="label-admin" style="margin-left: 20px " ><?php _e('餐宴內容一', 'suite'); ?></label> 
            <input type="text" name="a_meal_1"  id="a_meal_1"  value="<?php echo get_post_meta($post->ID, 'a_meal_1', true); ?>" /></br>
            <!--<label for="a_meal_date_1" class="label-admin" style="margin-left: 62px " ><?php _e('日期', 'suite'); ?></label> 
            <input type="text" maxlength="10" class="MyDate" name="a_meal_date_1" id="a_meal_date_1" style="width: 150px" value="<?php echo get_post_meta($post->ID, 'a_meal_time_1', true); ?>">
            <label for="meal_time_1" class="label-admin" style="margin-left: 20px " ><?php _e('時間', 'suite'); ?></label>   
            <input type="text" class="type-time" maxlength ="5" placeholder="00:00" name="a_meal_time_1" id="a_meal_time_1" value="<?php echo get_post_meta($post->ID, 'a_meal_time_1', true); ?>" /></br>-->
        </div>
        <div class="content">
            <label for="a_meal_2" class="label-admin" style="margin-left: 20px " ><?php _e('餐宴內容二', 'suite'); ?></label> 
            <input type="text" name="a_meal_2"  id="a_meal_2"  value="<?php echo get_post_meta($post->ID, 'a_meal_2', true); ?>" /></br>
           <!-- <label for="a_meal_date_2" class="label-admin" style="margin-left: 62px " ><?php _e('日期', 'suite'); ?></label> 
            <input type="text" maxlength="10" class="MyDate" name="a_meal_date_2" id="a_meal_date_2" style="width: 150px" value="<?php echo get_post_meta($post->ID, 'a_meal_time_2', true); ?>">
            <label for="a_meal_time_2" class="label-admin" style="margin-left: 20px " ><?php _e('時間', 'suite'); ?></label>   
            <input type="text" class="type-time" maxlength ="5" placeholder="00:00" name="a_meal_time_2" id="a_meal_time_2" value="<?php echo get_post_meta($post->ID, 'a_meal_time_2', true); ?>" /></br>-->
        </div>
        <div class="content">
            <label for="a_meal_3" class="label-admin" style="margin-left: 20px " ><?php _e('餐宴內容三', 'suite'); ?></label> 
            <input type="text" name="a_meal_3"  id="a_meal_3"  value="<?php echo get_post_meta($post->ID, 'a_meal_3', true); ?>" /></br>
            <!--<label for="a_meal_date_3" class="label-admin" style="margin-left: 62px " ><?php _e('日期', 'suite'); ?></label> 
            <input type="text" maxlength="10" class="MyDate" name="a_meal_date_3" id="a_meal_date_3" style="width: 150px" value="<?php echo get_post_meta($post->ID, 'a_meal_time_3', true); ?>">
            <label for="a_meal_time_3" class="label-admin" style="margin-left: 20px " ><?php _e('時間', 'suite'); ?></label>   
            <input type="text" class="type-time" maxlength ="5" placeholder="00:00" name="a_meal_time_3" id="a_meal_time_3" value="<?php echo get_post_meta($post->ID, 'a_meal_time_3', true); ?>" /></br>-->
        </div>
        <div class="content">
            <label for="a_meal_4" class="label-admin" style="margin-left: 20px " ><?php _e('餐宴內容四', 'suite'); ?></label> 
            <input type="text" name="a_meal_4"  id="a_meal_4"  value="<?php echo get_post_meta($post->ID, 'a_meal_4', true); ?>" /></br>
            <!--<label for="a_meal_date_4" class="label-admin" style="margin-left: 62px " ><?php _e('日期', 'suite'); ?></label> 
            <input type="text" maxlength="10" class="MyDate" name="a_meal_date_4" id="a_meal_date_4" style="width: 150px" value="<?php echo get_post_meta($post->ID, 'a_meal_time_4', true); ?>">
            <label for="a_meal_time_4" class="label-admin" style="margin-left: 20px " ><?php _e('時間', 'suite'); ?></label>   
            <input type="text" class="type-time" maxlength ="5" placeholder="00:00" name="a_meal_time_4" id="a_meal_time_4" value="<?php echo get_post_meta($post->ID, 'a_meal_time_4', true); ?>" /></br>-->
        </div>
        <div class="content">
            <label for="a_meal_5" class="label-admin" style="margin-left: 20px " ><?php _e('餐宴內容五', 'suite'); ?></label> 
            <input type="text" name="a_meal_5"  id="a_meal_5"  value="<?php echo get_post_meta($post->ID, 'a_meal_5', true); ?>" /></br>
            <!--<label for="a_meal_date_5" class="label-admin" style="margin-left: 62px " ><?php _e('日期', 'suite'); ?></label> 
            <input type="text" maxlength="10" class="MyDate" name="a_meal_date_5" id="a_meal_date_5" style="width: 150px" value="<?php echo get_post_meta($post->ID, 'a_meal_time_5', true); ?>">
            <label for="a_meal_time_5" class="label-admin" style="margin-left: 20px " ><?php _e('時間', 'suite'); ?></label>   
            <input type="text" class="type-time" maxlength ="5" placeholder="00:00" name="a_meal_time_5" id="a_meal_time_5" value="<?php echo get_post_meta($post->ID, 'a_meal_time_5', true); ?>" /></br>-->
        </div>
        <div class="content">
            <label for="a_note" class="label-admin" style="margin-left: 20px " ><?php _e('備註欄', 'suite'); ?></label> 
            <input type="text" name="a_meal_note"  id="a_meal_note"   value="<?php echo get_post_meta($post->ID, 'a_meal_note', true); ?>" /></br>
        </div>   
        <hr/>
        <div class="content">
            <h3 class='admin-title'><?php _e('備註', 'suite'); ?></h3>
            <?php wp_editor(get_post_meta($post->ID, 'a_note', true), 'a_note', $editor_settings); ?>
        </div>
        <!--ORTHER-->
        <hr/>
        <div class="content">
            <h3 class='admin-title' ><?php _e('其他 1') ?></h3>
            <div>
                <label class="label-admin" style="margin-left: 20px " ><?php _e('標題') ?> </label>
                <input type="text" name="a_orther_title_one"  id="a_orther_title_one"   value="<?php echo get_post_meta($post->ID, 'a_orther_title_one', true); ?>" /></br>
                <label class="label-admin" style="margin-left: 20px " ><?php _e('內容') ?> </label>
                <?php wp_editor(get_post_meta($post->ID, 'a_orther_content_one', true), 'a_orther_content_one', $editor_settings); ?>
            </div>
        </div>

        <hr/>
        <div class="content">
            <h3 class='admin-title' ><?php _e('其他 2') ?></h3>
            <div>
                <label class="label-admin" style="margin-left: 20px " ><?php _e('標題') ?> </label>
                <input type="text" name="a_orther_title_two"  id="a_orther_title_two"   value="<?php echo get_post_meta($post->ID, 'a_orther_title_two', true); ?>" /></br>
                <label class="label-admin" style="margin-left: 20px " ><?php _e('內容') ?> </label>
                <?php wp_editor(get_post_meta($post->ID, 'a_orther_content_two', true), 'a_orther_content_two', $editor_settings); ?>
            </div>
        </div>

        <hr/>
        <div class="content">
            <h3 class='admin-title' ><?php _e('其他 3') ?></h3>
            <div>
                <label class="label-admin" style="margin-left: 20px " ><?php _e('標題') ?> </label>
                <input type="text" name="a_orther_title_three"  id="a_orther_title_three"   value="<?php echo get_post_meta($post->ID, 'a_orther_title_three', true); ?>" /></br>
                <label class="label-admin" style="margin-left: 20px " ><?php _e('內容') ?> </label>
                <?php wp_editor(get_post_meta($post->ID, 'a_orther_content_three', true), 'a_orther_content_three', $editor_settings); ?>
            </div>
        </div>


        <hr/>
        <div class="content">
            <h3 class='admin-title' ><?php _e('其他 4') ?></h3>
            <div>
                <label class="label-admin" style="margin-left: 20px " ><?php _e('標題') ?> </label>
                <input type="text" name="a_orther_title_fore"  id="a_orther_title_fore"   value="<?php echo get_post_meta($post->ID, 'a_orther_title_fore', true); ?>" /></br>
                <label class="label-admin" style="margin-left: 20px " ><?php _e('內容') ?> </label>
                <?php wp_editor(get_post_meta($post->ID, 'a_orther_content_fore', true), 'a_orther_content_fore', $editor_settings); ?>
            </div>
        </div>


        <hr/>
        <div class="content">
            <h3 class='admin-title' ><?php _e('其他 5') ?></h3>
            <div>
                <label class="label-admin" style="margin-left: 20px " ><?php _e('標題') ?> </label>
                <input type="text" name="a_orther_title_five"  id="a_orther_title_five"   value="<?php echo get_post_meta($post->ID, 'a_orther_title_five', true); ?>" /></br>
                <label class="label-admin" style="margin-left: 20px " ><?php _e('內容') ?> </label>
                <?php wp_editor(get_post_meta($post->ID, 'a_orther_content_five', true), 'a_orther_content_five', $editor_settings); ?>
            </div>
        </div>

        <!--AN BUTTON ADD MEDIA OF EDITOR-->
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('.add_media').css('display', 'none');
            });
        </script>
        <?php
    }

    public function save($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (is_admin()) {
            if (@$_POST['post_type'] == 'apply') {
                if (isset($_POST['a_dontiep_1'])) {
                    update_post_meta($post_id, 'a_dontiep_1', $_POST['a_dontiep_1']);
                }
                if (isset($_POST['a_dontiep_2'])) {
                    update_post_meta($post_id, 'a_dontiep_2', $_POST['a_dontiep_2']);
                }
                if (isset($_POST['a_dontiep_3'])) {
                    update_post_meta($post_id, 'a_dontiep_3', $_POST['a_dontiep_3']);
                }
                if (isset($_POST['a_dontiep_4'])) {
                    update_post_meta($post_id, 'a_dontiep_4', $_POST['a_dontiep_4']);
                }
                if (isset($_POST['a_dontiep_5'])) {
                    update_post_meta($post_id, 'a_dontiep_5', $_POST['a_dontiep_5']);
                }
                if (isset($_POST['a_attend'])) {
                    update_post_meta($post_id, 'a_attend', $_POST['a_attend']);
                }
                if (isset($_POST['a_hotel'])) {
                    update_post_meta($post_id, 'a_hotel', $_POST['a_hotel']);
                }
                if (isset($_POST['a_room_fee'])) {
                    update_post_meta($post_id, 'a_room_fee', $_POST['a_room_fee']);
                }
                if (isset($_POST['a_room_note'])) {
                    update_post_meta($post_id, 'a_room_note', $_POST['a_room_note']);
                }

                if (isset($_POST['a_meal_1'])) {
                    update_post_meta($post_id, 'a_meal_1', $_POST['a_meal_1']);
                }
                /*    if (isset($_POST['a_meal_date_1'])) {
                  update_post_meta($post_id, 'a_meal_date_1', $_POST['a_meal_date_1']);
                  }
                  if (isset($_POST['a_meal_time_1'])) {
                  update_post_meta($post_id, 'a_meal_time_1', $_POST['a_meal_time_1']);
                  } */

                if (isset($_POST['a_meal_2'])) {
                    update_post_meta($post_id, 'a_meal_2', $_POST['a_meal_2']);
                }
                /* if (isset($_POST['a_meal_date_2'])) {
                  update_post_meta($post_id, 'a_meal_date_2', $_POST['a_meal_date_2']);
                  }
                  if (isset($_POST['a_meal_time_2'])) {
                  update_post_meta($post_id, 'a_meal_time_2', $_POST['a_meal_time_2']);
                  } */

                if (isset($_POST['a_meal_3'])) {
                    update_post_meta($post_id, 'a_meal_3', $_POST['a_meal_3']);
                }
                /* if (isset($_POST['a_meal_date_3'])) {
                  update_post_meta($post_id, 'a_meal_date_3', $_POST['a_meal_date_3']);
                  }
                  if (isset($_POST['a_meal_time_3'])) {
                  update_post_meta($post_id, 'a_meal_time_3', $_POST['a_meal_time_3']);
                  } */

                if (isset($_POST['a_meal_4'])) {
                    update_post_meta($post_id, 'a_meal_4', $_POST['a_meal_4']);
                }
                /* if (isset($_POST['a_meal_date_4'])) {
                  update_post_meta($post_id, 'a_meal_date_4', $_POST['a_meal_date_4']);
                  }
                  if (isset($_POST['a_meal_time_4'])) {
                  update_post_meta($post_id, 'a_meal_time_4', $_POST['a_meal_time_4']);
                  } */

                if (isset($_POST['a_meal_5'])) {
                    update_post_meta($post_id, 'a_meal_5', $_POST['a_meal_5']);
                }
                /* if (isset($_POST['a_meal_date_5'])) {
                  update_post_meta($post_id, 'a_meal_date_5', $_POST['a_meal_date_5']);
                  }
                  if (isset($_POST['a_meal_time_5'])) {
                  update_post_meta($post_id, 'a_meal_time_5', $_POST['a_meal_time_5']);
                  } */

                if (isset($_POST['a_meal_note'])) {
                    update_post_meta($post_id, 'a_meal_note', $_POST['a_meal_note']);
                }

                if (isset($_POST['a_note'])) {
                    update_post_meta($post_id, 'a_note', $_POST['a_note']);
                }

                // SEVA ORTHER    
                if (isset($_POST['a_orther_title_one'])) {
                    update_post_meta($post_id, 'a_orther_title_one', $_POST['a_orther_title_one']);
                }

                if (isset($_POST['a_orther_content_one'])) {
                    update_post_meta($post_id, 'a_orther_content_one', $_POST['a_orther_content_one']);
                }

                if (isset($_POST['a_orther_title_two'])) {
                    update_post_meta($post_id, 'a_orther_title_two', $_POST['a_orther_title_two']);
                }

                if (isset($_POST['a_orther_content_two'])) {
                    update_post_meta($post_id, 'a_orther_content_two', $_POST['a_orther_content_two']);
                }

                if (isset($_POST['a_orther_title_three'])) {
                    update_post_meta($post_id, 'a_orther_title_three', $_POST['a_orther_title_three']);
                }

                if (isset($_POST['a_orther_content_three'])) {
                    update_post_meta($post_id, 'a_orther_content_three', $_POST['a_orther_content_three']);
                }

                if (isset($_POST['a_orther_title_fore'])) {
                    update_post_meta($post_id, 'a_orther_title_fore', $_POST['a_orther_title_fore']);
                }

                if (isset($_POST['a_orther_content_fore'])) {
                    update_post_meta($post_id, 'a_orther_content_fore', $_POST['a_orther_content_fore']);
                }

                if (isset($_POST['a_orther_title_five'])) {
                    update_post_meta($post_id, 'a_orther_title_five', $_POST['a_orther_title_five']);
                }

                if (isset($_POST['a_orther_content_five'])) {
                    update_post_meta($post_id, 'a_orther_content_five', $_POST['a_orther_content_five']);
                }

                add_action('redirect_post_location', 'custom_redirect');
            }
        }
    }

}
