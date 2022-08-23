<?php
require_once(DIR_MODEL.'admin-model-member.php');
$dataList = new Admin_Model_Member();
$dataList->prepare_items();
$lbl = '';
$page =  getParams('page');
$linkAdd  = admin_url('admin.php?page=' . $page . '&action=add');  // tạo link cho add new
$lblAdd    = __('Add Member Item');
$msg = '';
if(getParams('msg') == 1){
    $msg .= '<div class="updated notice notice-success is-dismissible"><p>'.__('Data Adjustment succeeded').'</p></div>';
}

?>
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