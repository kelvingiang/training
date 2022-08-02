<?php
require_once(DIR_MODEL.'check_in_model.php');
$dataList = new Check_In_Model();
$dataList->prepare_items();
$lbl = '';
$page =  getParams('page');
$linkAdd  = admin_url('admin.php?page=' . $page . '&action=add');  // TAO LINH CHO ADD NEW
$lblAdd    = __('Add Item');
if(getParams('msg') == 1){
    $msg .= '<div class="updated notice notice-success is-dismissible"><p>'.__('Data Adjustment succeeded').'</p></div>';
}

?>
<style type="text/css">
    .column-serial{
        width: 100px;
    }
    .column-code{
        width: 130px
    }
    .column-email{
        width: 250px
    }
    .column-name{
        width: 100px;
    }
    .column-mobile, .column-image{
        width: 80px;
    }
    .column-company{
        width: 300px
    }
</style>
 <div class="wrap">
     <h2 style="font-weight: bold">
         <?php echo esc_html__($lbl); ?>
         <a href ="<?php echo esc_url($linkAdd); ?>"  class ="add-new-h2"><?php  echo esc_html__($lblAdd); ?></a>
     </h2>
     <?php echo @$msg; ?>
     <form action ="" method="post" name="<?php echo $page; ?>" id="<?php echo $page; ?>">
         <?php $dataList->search_box(__('Search'), 'search_id') ?>
         <?php  $dataList->views(); ?>
         <?php $dataList->display(); ?>
     </form>
 </div>