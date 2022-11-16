<?php
$page = getParams('page');
$action = (getParams('action') != ' ') ? getParams('action') : 'add';
$msg = '';
//---------------------------------------------------------------------------------------------
// Cmt KIEM TRA NEU CO LOI THI DUA LOI VAO BIEN  $msg VAO SHOW $msg 
//---------------------------------------------------------------------------------------------
if (count($error) > 0) {
    $msg .= '<div class="error"><ul>';
    foreach ($error as $key => $value) {
        $msg .= '<li>' . $value . '</li>';
    }
    $msg .= '</ul></div>';
}
//---------------------------------------------------------------------------------------------
require_once(DIR_MODEL . 'model_schedule.php');
$model = new Admin_Model_Schedule();
$data = $model->get_item(getParams('id'));


?>
<div class=" wrap">
    <h2><?php echo $lbl ?></h2>
    <?php echo $msg ?>

    <form action="" method="post" enctype="multipart/form-data" id="<?php $page ?>" name="<?php $page ?>">
        <input name="action" value="<?php echo $action; ?>" type="hidden">
        <?php wp_nonce_field($action, 'security_code', true); ?>

        <div class="row-one-column">
            <div class="cell-title">
                <label><?php echo __('Title'); ?></label>
            </div>
            <div class="cell-text">
                <input type="text" id="txt-title" name="txt-title" class="my-input" value="<?php echo $data['title']; ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="cell-title">
                <label><?php echo __('Date'); ?></label>
            </div>
            <div class="cell-text">
                <input type="text" id="datepicker" name="txt-date" maxlength="10" value="<?php echo $data['date'] ?>" />
                <label>星期</label>
                <input type="text" id="dayOfWeek" name="txt-weekdays" value="<?php echo $data['weekdays'] ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="cell-title">
                <label><?php echo __('Time'); ?></label>
            </div>
            <?php $time = explode('-', $data['time']); ?>
            <div class="cell-text">
                <input type="text" id="timeStart" name="txt-timeStart" class="type-time" maxlength="5" onkeyup="timeInput('#timeStart');" value="<?php echo $time[0] ?>" />
                <label>至</label>
                <input type="text" id="timeEnd" name="txt-timeEnd" class="type-time" maxlength="5" onkeyup="timeInput('#timeEnd');" value="<?php echo $time[1] ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="cell-title">
                <label><?php echo __('Branch'); ?></label>
            </div>
            <div class="cell-text">
                <?php
                $args = array(
                    'post_type' => 'brach',
                    'post_status' => 'publish',
                    'showposts' => -1
                );
                $my_query = new WP_Query($args);
                ?>
                <select id="sel-branch" name="sel-branch">
                    <?php
                    if ($my_query->have_posts()) {
                        while ($my_query->have_posts()) : $my_query->the_post();
                            echo  "sss";
                    ?>
                            <option value="<?php echo get_the_title() ?>"><?php the_title() ?></option>
                    <?php endwhile;
                    }
                    wp_reset_query();  // Restore global post data stomped by the_post()
                    ?>
                </select>
            </div>
        </div>

        <div class="row-one-column">
            <div class="cell-title">
                <label><?php echo translate('Place'); ?></label>
            </div>
            <div class="cell-text">
                <input type="text" name="txt-place" id="txt-place" class="my-input" value="<?php echo $data['place']; ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="cell-title">
                <label><?php echo translate('Note'); ?></label>
            </div>
            <div class="cell-text">
                <textarea id=txt-note" name="txt-note" rows="10" cols="100%"><?php echo  $data['note'] ?></textarea>
            </div>
        </div>
        <div class="btn-add-space">
            <input name="submit" id="submit" class="button button-primary" value="<?php _e('Submit') ?>" type="submit">
        </div>
    </form>

</div>

<!--DOAN SCRIPT HIEN THI NGAY VA THU TRONG TUAN-->
<script type="text/javascript">
    function timeInput(e) {
        jQuery(e).keyup(function(event) {
            if (event.which !== 8) {
                var so = jQuery(this).val().length;
                if (so === 2) {
                    var kq = jQuery(this).val() + ':';
                    jQuery(this).val(kq);
                }
            } else {
                jQuery(this).val('');
            }
        });
    }



    jQuery(function() {
        // $('#dayOfWeek').attr('readonly', true);

        jQuery('#datepicker').datepicker({
            dateFormat: 'dd/mm/yy',
            showAnim: 'show',
            onSelect: function(dateText) {
                var seldate = jQuery(this).datepicker('getDate');
                seldate = seldate.toDateString();
                seldate = seldate.split(' ');
                var weekday = new Array();
                weekday['Mon'] = "星期一";
                weekday['Tue'] = "星期二";
                weekday['Wed'] = "星期三";
                weekday['Thu'] = "星期四";
                weekday['Fri'] = "星期五";
                weekday['Sat'] = "星期六";
                weekday['Sun'] = "星期天";
                var dayOfWeek = weekday[seldate[0]];
                jQuery('#dayOfWeek').val(dayOfWeek); //.attr('readonly', true)
            },
            onClose: closeDatePicker_datepicker_1
        });
    });

    function closeDatePicker_datepicker_1() {
        var tElm = jQuery('#datepicker');
        if (typeof datepicker_1_Spry != null && typeof datepicker_1_Spry != "undefined" && test_Spry.validate) {
            datepicker_1_Spry.validate();
        }
        tElm.blur();
    }
</script>