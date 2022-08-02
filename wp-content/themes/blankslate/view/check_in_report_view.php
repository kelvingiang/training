<?php
$page = getParams('page');
require_once(DIR_MODEL . 'check_in_report_model.php');
$data = new Check_In_Report_Model();
?>
<style type="text/css">
</style>
<div class="wrap">
    <div class="report_head" style="height: 60px; margin-top: 20px">

        <a style=' margin-top: 2px; margin-right: 40px; letter-spacing: 4px ' 
           class="button button-primary button-large" 
           href="<?php echo "admin.php?page=$page&action=export" ?>"> <?php echo __('Export to Excel') ?></a>

        <a style=' margin-top: 2px; margin-right: 40px; letter-spacing: 4px ' 
           class="button button-primary button-large" 
           href="<?php echo "admin.php?page=$page&action=waiting" ?>"><?php echo __('Setting title and check in time') ?></a>

    </div>
    <div>
        <h3><?php echo __('Register Total') . ' : ' . $data->RegisterCount() ?></h3>
    </div>
    <div>
        <h3> <?php echo __('Attend Total') . ' : ' . $data->AttendCount(); ?></h3>    
    </div>    

        <div class="report-grid">
            <div class="report-title">
                <div class="col-serial"><h3><?php echo __('Serial') ?> </h3> </div>
                <div class="col-time"> <h3><?php echo __('Check In Time') ?> </h3> </div>
                <div class="col-name" > <h3> <?php echo __('Name') ?> </h3>  </div>
                <div class="col-company"><h3> <?php echo __('Company Name') ?> </h3> </div>
                <div class="col-phone"><h3><?php echo __('Phone') ?></h3>  </div>
            </div>
            <?php foreach ($data->CheckInList() as $item) { ?>
                <div class="report-list">
                    <div class="col-serial"> <?php echo $item['serial'] ?>  </div>
                    <div class="col-time"> <?php echo $item['time'] . '&nbsp __ &nbsp' . $item['date'] ?>  </div>
                    <div class="col-name" > <?php echo $item['name'] ?>  </div>
                    <div class="col-company"> <?php echo $item['company'] ?>  </div>
                    <div class="col-phone"> <?php echo $item['phone'] == "" ? '&nbsp ' : $item['phone'] ?>  </div>
                </div>
            <?php } ?>
        </div>
</div>