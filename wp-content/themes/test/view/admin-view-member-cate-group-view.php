<?php
include_once (DIR_MODEL . 'admin-model-member-cate.php');
$model = new Admin_Model_Member_Cate();
$data = $model->getDataGroup(); //lấy tất cả dữ liệu
$page = getParams('page'); 
$val = array(
    'ID' => '',
    'cate_name' => '',
    'type' => '',
);

if(getParams('action') == 'edit' && !empty(getParams('id'))) {
    $val = $model->getGroupItem(getParams('id'));
}
?>

<div>
    <div style="width: 50%; float: left">
        <form id="cate-form" name="cate-form" action="" method="post">
            <input type="hidden" id="hidden_id" name="hidden_id" value="<?php echo $val['ID'] ?>"/>
            <h1>Member Group</h1>
            <div class="meta-row">
                <div class="title-cell">
                    <label><?php echo __('Name'); ?><i id="error-cate-name" class="error"></i></label>
                </div>
                <div class="text-cell">
                    <input class="type-text" type="text" id="txt-cate-name" name="txt-cate-name" value="<?php echo $val['cate_name'] ?>"/>
                </div>
            </div> 
            <div class="button-row">
                <input type="button" name="btn-submit" id="btn-submit" class="button button-primary button-large" value="<?php echo __('Send') ?>"/>
            </div>
        </form>
    </div>
    <div style="width: 50%;float: left">
        <div class="button-row">
            <input type="submit" name="btn-add" id="btn-add" 
                class="button button-primary button-large" value="<?php echo __('Add New') ?>" onclick="addNew('add')"/>
        </div>
        <ul class="category_list">
            <li>
                <div><?php _e('ID') ?></div>
                <div><?php _e('Name') ?></div>
                <div><?php _e('Use') ?></div>
            </li>
            <?php
            foreach ($data as $val) {
                ?>
                <li>
                    <div><label><?php echo $val['ID'] ?></label></div>
                    <div><a href="<?php echo "admin.php?page=$page&action=edit&id=" . $val["ID"] ?>"><?php echo $val['cate_name'] ?></a></div>
                    <div>
                    <?php
                        $count = $model->countGroupItem($val['ID']);
                        if ($count != 0) { ?>
                            <a><?php echo $count ?></a>
                    <?php   }else{ ?>
                        <a  onclick="myFunction('<?php echo __('do you sure to delete this category ?') ?>', 'del', <?php echo $val['ID'] ?>)"
                        style="color: red" > <?php _e('Delete') ?></a>
                    <?php } ?>    
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<script type="text/javascript" >
    function myFunction($mess, $action, $id) {
        if (confirm($mess)) {
            location.href = "<?php echo "admin.php?page=$page&action=" ?>" + $action + "&id=" + $id;
        } else {
            window.stop();
        }
    }

    function addNew($action){
        if($action == 'add'){
            location.href = "<?php echo "admin.php?page=$page&action=" ?>" + $action;
        }
    }

    jQuery(document).ready(function(){
        jQuery('#btn-submit').click(function(e){
            var name = document.getElementById('txt-cate-name');
            if( !jQuery(name).val() ) { //is empty
                jQuery('#error-cate-name').text('Please enter category name! ');
                name.focus(); 
            }else{
                jQuery('#error-cate-name').text(' ');
                jQuery('#cate-form').submit()
            }    
        })
    })
</script>