<?php

class Admin_Metabox_Event {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        $id = 'event-metabox-box';
        $title = '設定';
        $callback = array($this, 'display');
        $screen = array('event'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
        add_meta_box($id, $title, $callback, $screen);
    }

    public function display($post) {
// LAY DATA DA TON TAI CHO VE CAP NHAP
        $e_show = get_post_meta($post->ID, 'e_show', true);
        $e_join = get_post_meta($post->ID, 'e_join', true);
        ?>
        <div class="row-four-clo">
            <div class="cell-one"><label for="e_time" class="label-admin"  ><?php _e('開始日期', 'suite'); ?></label></div>
            <div class="cell-two"><input type="text" class="MyDate type-date" maxlength ="10" placeholder="mm-dd-yy" name="e_start_date" id="e_start_date" value="<?php echo get_post_meta($post->ID, 'e_start_date', true); ?>" /></div>
            <div class="cell-three"><label for="e_time" class="label-admin" ><?php _e('時間', 'suite'); ?></label></div>
            <div class="cell-four"><input type="text" class=" type-time "  maxlength ="5" placeholder="00:00" name="e_start_time" id="e_start_time" value="<?php echo get_post_meta($post->ID, 'e_start_time', true); ?>" /></div>
        </div>
        <div class="row-four-clo">
            <div class="cell-one"> <label for="e_time" class="label-admin" ><?php _e('結束日期', 'suite'); ?></label></div>
            <div class="cell-two"> <input type="text" class="MyDate type-date" maxlength ="10"  placeholder="mm-dd-yy" name="e_end_date" id="e_end_date" value="<?php echo get_post_meta($post->ID, 'e_end_date', true); ?>" /> </div>
            <div class="cell-three"> <label for="e_time" class="label-admin" ><?php _e('時間', 'suite'); ?></label></div>
            <div class="cell-four"> <input type="text" class="type-time" maxlength ="5" placeholder="00:00" name="e_end_time" id="e_end_time" value="<?php echo get_post_meta($post->ID, 'e_end_time', true); ?>" /></div>
        </div>
        <div class="row-one-clo">
            <div class="cell-one">
                <label class="label-admin"><?php _e('特殊顯示在首頁'); ?></label>
            </div>
            <div class="cell-two">
                <input type="checkbox" id="e_show" name="e_show" style="margin-top: 10px" <?php echo checked($e_show, 'on', false); ?>  />
            </div>
        </div>

        <div class="row-one-clo">
            <div class="cell-one"><label class="label-admin"><?php _e('准許參加活動'); ?></label> </div>
            <div class="cell-two"><input type="checkbox" id="e_join" name="e_join" id="e_join" style="margin-top: 10px" <?php echo checked($e_join, 'on', false); ?>   /> </div>
        </div>
        <label  id="event_merss" name="event_merss" style=" font-weight: bold; color: red; padding-top: 10px" ></label>
        </div>

        <!--javascript kiem tra event da su dung chua -->
        <script type="text/javascript">
            jQuery(document).ready(function () {
                var join = '<?php echo $e_join; ?>';
                if (join === 'off' || join === '') {
                    jQuery('#e_join').change(function (e) {
                        var urlPath = '<?php echo get_template_directory_uri() . '/ajax/admin/check-event.php' ?>';
                        jQuery.ajax({
                            url: urlPath, // lay doi tuong chuyen sang dang array
                            type: 'post',
                            data: $(this).serialize(),
                            dataType: 'json',
                            success: function (data) {  // set ket qua tra ve  data tra ve co thanh phan status va message
                                if (data.status === 'done') {
                                    jQuery('#event_merss').text(data.message);
                                    jQuery("#e_join").prop("checked", false);
                                } else if (data.status === 'error') {
                                    jQuery('#event_merss').text(data.message);
                                }
                            },
                            error: function (xhr) {
                                console.log(xhr.reponseText);
                            }
                        });
                        e.preventDefault();
                    });
                }
            });
        </script>

        <?php
    }

    public function save($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (is_admin()) {
            if (@$_POST['post_type'] == 'event') {
                if (isset($_POST['e_start_date'])) {
                    update_post_meta($post_id, 'e_start_date', $_POST['e_start_date']);
                }
                if (isset($_POST['e_start_time'])) {
                    update_post_meta($post_id, 'e_start_time', $_POST['e_start_time']);
                }
                if (isset($_POST['e_end_time'])) {
                    update_post_meta($post_id, 'e_end_time', $_POST['e_end_time']);
                }
                if (isset($_POST['e_end_date'])) {
                    update_post_meta($post_id, 'e_end_date', $_POST['e_end_date']);
                }
                if (isset($_POST['e_show'])) {
                    update_post_meta($post_id, 'e_show', $_POST['e_show']);
                } else {
                    update_post_meta($post_id, 'e_show', 'off');
                }
                if (isset($_POST['e_join'])) {
                    update_post_meta($post_id, 'e_join', $_POST['e_join']);
                } else {
                    update_post_meta($post_id, 'e_join', 'off');
                }
            }
        }
    }

}
