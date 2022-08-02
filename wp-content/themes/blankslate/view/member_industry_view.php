<?php
include_once (DIR_MODEL . 'member_industry_model.php');
$model = new Member_Industry_Model();
$data = $model->getData();
$page = getParams('page');

$industryAll = $model->getMemberIndustry();
foreach ($industryAll as $val) {
    $ss .= $val['industry_id'] . ',';
}
$ss = substr($ss, 0, -1);
$arr = explode(',', $ss);
$arr_id = array_count_values($arr); //THONG KE GIA TRI VA SO LUONG TRUNG TRONG ARRAY

if (getParams('action') == 'edit' && !empty(getParams('id'))) {
    $val = $model->getItem(getParams('id'));
}
?>
<div>
    <div style="width: 50%; float: left">
        <form id="f1" name="f1" action="" method="post">
            <input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo $val['ID'] ?>"/>
            <div class="meta-row">
                <div class="title-cell">
                    <label><?php echo __('Name'); ?></label>
                </div>
                <div class="text-cell">
                    <input type="text" id="txt_name" name="txt_name" value="<?php echo $val['name'] ?>"/>
                </div>
            </div> 
            <div class="meta-row">
                <div class="title-cell">
                    <label><?php echo __('Order'); ?></label>
                </div>
                <div class="text-cell">
                    <input type="text" id="txt_order" name="txt_order" class="type-phone" maxlength="10" value="<?php echo $val['order'] ?>"/>
                </div>
            </div> 
            <div class="button-row">
                <input type="submit" name="btn-submit" id="btn-submit" class="button button-primary button-large" value="<?php echo __('Send') ?>"/>
            </div>
        </form>
    </div>
    <div style="width: 50%;float: left">
        <ul class="industry_list">
            <li>
                <div><?php _e('ID') ?></div>
                <div><?php _e('Name') ?></div>
                <div><?php _e('Order') ?></div>
                <div><?php _e('Use') ?></div>
            </li>
            <?php
            foreach ($data as $val) {
                ?>
                <li>
                    <div><label><?php echo $val['ID'] ?></label></div>
                    <div><a href="<?php echo "admin.php?page=$page&action=edit&id=" . $val["ID"] ?>"><?php echo $val['name'] ?></a></div>
                    <div><?php echo $val['order'] ?></div>
                    <div>
                        <?php
                        $flag = FALSE;
                        foreach ($arr_id as $key => $valID) {
                            if ($key == $val['ID']) {
                                ?>
                                <a href="<?php echo "admin.php?page=page_member&filter_branch=" . $val['ID'] ?>"> <?php echo $valID; ?></a>  
                                <?php
                                $flag = TRUE;
                            }
                        }
                        ?>
                        <?php if (!$flag) { ?>
                            <a   onclick="myFunction('<?php echo __('do you sure to delete this industry ?') ?>', 'del', <?php echo $val['ID'] ?>)"   style="color: red" > <?php _e('Delete') ?></a>
                <?php } ?>
                    </div>
                </li>
<?php } ?>
        </ul>
    </div>
</div>
<style type="text/css">
    .industry_list {
        border: 1px solid #666;
        margin: 5px;
        border-radius: 3px
    }
    .industry_list li {
        border-bottom: 1px  #666 solid;
        line-height: 35px;
        padding: 0px;
        margin: 0px;
        height: 35px;
    }
    .industry_list li:last-child{
        border-bottom: 0px;
    }
    .industry_list li:first-child{
        height: 50px;
        background-color:  #068afd;
        color: white;
        line-height: 50px;
        font-size: 17px;
        font-weight:  bold;
    }
    .industry_list li:nth-child(even){
        background-color: white;
        display:  block;
    }
    .industry_list li div{
        float: left;
        text-align: center;
        height: 30px
    }
    .industry_list li div:nth-child(1){
        width: 20%;
    }
    .industry_list li div:nth-child(2){
        width: 40%;
    }
    .industry_list li div:nth-child(3){
        width:25%;
    }
    .industry_list li div:nth-child(4){
        width: 15%;
    }

    .industry_list li div a{
        text-decoration:  none;
        font-weight: bold;
    }
</style>
<script type="text/javascript" >
    function myFunction($mess, $action, $id) {
        if (confirm($mess)) {
            location.href = "<?php echo "admin.php?page=$page&action=" ?>" + $action + "&id=" + $id;
        } else {
            window.stop();
        }
    }
</script>