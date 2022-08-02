<?php
if (!empty(getParams('id'))) {
    require_once (DIR_MODEL . 'schedule_model.php');
    $model = new Schedule_Model();
    $data = $model->get_item(getParams());
}
?>
<!--DOAN SCRIPT HIEN THI NGAY VA THU TRONG TUAN-->
<form action="" method="post" enctype="multipart/form-data" id="f-schedule" name="f-schedule" >
    <div class="title-row">
        <?php
        $action = getParams('action');
        if ($action == 'edit') {
            $title = __('Update Schedule Info');
        } elseif ($action == 'add') {
            $title = __('Add New Schedule');
        }
        ?>
        <h2> <?php echo $title; ?></h2>
    </div>
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Event Title'); ?><i class="error" id="event_title_merss"></i></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-event-title" id="txt-event-title" value="<?php echo $data['title'] ?>"  /> 
        </div>
    </div>    
    <div class="meta-row">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Date'); ?><i class="error" id="date_merss"></i></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-date" id="txt-date" style="width: 100px"   value="<?php echo $data['date'] ?>" /> 
                <label> - </label>
                <input type="text" name="txt-week" id="txt-week" style="width: 100px"   value="<?php echo $data['weekdays'] ?>" />
            </div>
        </div>
    </div>   

    <div class="meta-row">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Time'); ?><i class="error" id="time_merss"></i></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-start-time" id="txt-start-time" class="type-time type-number" placeholder="00:00"  style="width: 100px"  value="<?php echo $data['start_time'] ?>" /> 
                <label> <?php echo __('To') ?> </label>
                <input type="text" name="txt-end-time" id="txt-end-time" class="type-time type-number" placeholder="00:00"  style="width: 100px"   value="<?php echo $data['end_time'] ?>" />
            </div>
        </div>
    </div>   

    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Place'); ?><i class="error" id="place_merss"></i></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-place" id="txt-place" value="<?php echo $data['place'] ?>"  /> 
        </div>
    </div>    

    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Note'); ?><i class="error" id="place_merss"></i></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-note" id="txt-note" value="<?php echo $data['note'] ?>"  /> 
        </div>
    </div>  
    <div class="button-row">
        <input type="submit" name="btn-submit" id="btn-submit" class="button button-primary button-large" value="<?php echo __('Send') ?>"/>
    </div>
</form>

<script type="text/javascript">
    jQuery(function () {
        // $('#dayOfWeek').attr('readonly', true);

        jQuery('#txt-date').datepicker({
            dateFormat: 'dd/mm/yy',
            showAnim: 'show',
            onSelect: function (dateText) {
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
                jQuery('#txt-week').val(dayOfWeek);//.attr('readonly', true)
            },
            onClose: closeDatePicker_datepicker_1
        });
    });
    function closeDatePicker_datepicker_1() {
        var tElm = jQuery('#txt-date');
        if (typeof datepicker_1_Spry != null && typeof datepicker_1_Spry != "undefined" && test_Spry.validate) {
            datepicker_1_Spry.validate();
        }
        tElm.blur();
    }
</script>