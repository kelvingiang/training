<?php
//require_once ( HCM_DIR_MODEL . 'check_in_report_model.php' );
//$model = new Admin_Check_In_Report_model();
//$list = $model->ReportView();
$page = getParams('page');
$msg = getParams('msg');

//$list = $model->ReportjoinView();
?>
<div id="check_setting">
    <div>
        <form name="f-title" id="f-title" method="get" >
            <a id="btn-submit" class="btn button button-primary button-large" > 標題 </a>
            <input type="text" name="txt-title"  id="txt-title" value="<?php echo get_option('_vote_title') ?>" style="width: 50%; height: 32px" /> 
        </form>
    </div>

    <div>
        <a class="btn button button-primary button-large" 
           href="<?php echo "admin.php?page=$page&action=lishi" ?>" 
           >總票數設為 0 </a>
        <label style=" margin-left: 30px; font-weight: bold"> 總票數 ： <?php echo get_option('_vote_total_lishi') ?></label> 
    </div>

    <div>
        <a class="btn button button-primary button-large"
           href="<?php echo "admin.php?page=$page&action=vote" ?>"
           >所有候選票設為 0 </a>
    </div>
    <!--    <div>
            <a class="btn button button-primary button-large"
               href="<?php echo "admin.php?page=$page&action=jianshi" ?>"
               >監事總票設為 0 </a>
            <label style=" margin-left: 30px; font-weight: bold"> 監事總票數 ： <?php echo get_option('_vote_total_jianshi') ?></label> 
        </div>-->
    <div>
        <a class="btn button button-primary button-large"
           href="<?php echo "admin.php?page=$page&action=export&id=1" ?>"
           >導出理事結果 </a>
    </div>
    <div>
        <a class="btn button button-primary button-large"
           href="<?php echo "admin.php?page=$page&action=export&id=2" ?>"
           >導出監事結果 </a>
    </div>

    <hr>

</div>

<style>
    #check_setting div{
        margin-top: 10px;
    }
    .btn-warning{
        background-color: red !important;
        color: white !important;
        border-radius: 5px !important;
    }
    .btn {
        margin-top: 2px; 
        margin-right: 20px; 
        letter-spacing: 4px   
    }

    #mess{
        height: 50px; 
        margin: 10px 10px 10px 0px; 
        background-color:#bedde9;
        border-radius: 3px;
        color: #8e8e8f;
        position: relative;
    }


    #mess .close{
        position: absolute;
        top:-8px;
        right: 8px;
        font-weight: bold;
        cursor: pointer;
    }
    #mess .mess_text h3{
        color: #8e8e8f;
        margin-left: 30px;
        line-height: 2.8;
        letter-spacing: 3px;
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#btn-submit").on("click", function () {
            var content = jQuery('#txt-title').val();
            window.location.replace("admin.php?page=<?php echo $page ?>&action=title&content=" + content);
        });
    });


</script>
