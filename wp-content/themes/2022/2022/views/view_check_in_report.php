<?php
require_once DIR_CODES . 'my-list.php';
$myList = new Codes_My_List();

require_once(DIR_MODEL . 'model_check_in_report.php');
$model = new Admin_Model_Check_In_Report();
//$list = $model->ReportView();
$registerTotal = $model->RegisterTotal();
$listGuests = $model->ReportjoinView();
//$listMember = $model->ReportjoinViewMember();
//$list = array_merge($listGuests,$listMember);

$page = getParams('page');
$branch = $model->ReportBranchView();

//sap xep div>u tu mang trong mang
uasort($branch, 'sort_by_order');
function sort_by_order($a, $b)
{
    //            return $a['percent'] - $b['percent'];
    return $b['percent'] - $a['percent'];
}
?>
<div class="report_head" style="height: 60px; margin-top: 20px">
    <a class="button button-primary" href="<?php echo home_url('print-check-in'); ?>" target="_blank"> <?php _e('Print Report'); ?></a>
    <a class="button button-primary" href="<?php echo "admin.php?page=$page&action=waiting" ?>"><?php _e('Title & Check in Time') ?></a>
</div>

<div>
    <div class="check-in-total">
        <label><?php echo __('Total of registrations') . ' : ' . $registerTotal['COUNT(ID)']; ?></label>
        <br> <label><?php echo __('Total attendance') . ' : ' . count($listGuests); ?></label>
    </div>

    <div id="bao-cao">
        <div class=" bao-cao-row bao-cao-header">
            <div>
                <label> <?php _e('Branch') ?></label>
            </div>
            <div>
                <label> <?php _e('Registration') ?></label>
            </div>
            <div>
                <label><?php _e('Attend') ?></label>
            </div>
            <div>
                <label> <?php _e('Ratio') ?></label>
            </div>
        </div>

        <?php foreach ($branch as $key => $val) {
        ?>
            <div class="bao-cao-row">
                <div> <label><?php echo $val['code']; ?></label></div>
                <div> <label><?php echo $val['register']; ?></label></div>
                <div> <label><?php echo $val['arrived']; ?></label></div>
                <div> <label><?php echo $val['percent']; ?> %</label></div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<div class="check-in-content">
    <div class="check-in-content-row header-style">
        <div></div>
        <div>
            <label><?php _e('Full Name'); ?></label>
        </div>
        <div>
            <label><?php _e('Branch') ?></label>
        </div>
        <div>
            <label><?php _e('Positions'); ?></label>
        </div>
        <div>
            <label><?php _e('Check-In') ?></label>
        </div>
        <div>
            <label><?php _e('Phone') ?></label>
        </div>
        <div>
            <label><?php _e('E-mail') ?></label>
        </div>
    </div>
    <?php foreach ($listGuests as $key => $val) { ?>
        <div class="check-in-content-row">
            <div><label><?php echo $key + 1 ?></label></div>
            <div><label><?php echo $val['full_name'] ?></label></div>
            <div><label><?php echo $myList->get_country($val['country']) ?></label></div>
            <div><label><?php echo $val['position'] ?></label></div>
            <div><label><?php echo $val['time'] . ' -- ' . $val['date']; ?></label></div>
            <div><label><?php echo $val['phone'] ?></label></div>
            <div><label><?php echo $val['email'] ?></label></div>
        </div>
    <?php } ?>
</div>