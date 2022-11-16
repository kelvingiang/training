<?php
require_once(DIR_MODEL . 'model_schedule.php');
$show_list = new Admin_Model_Schedule();
$show_list->prepare_items();
$lbl = __('Calendars');
$page =  getParams('page');
$linkAdd  = admin_url('admin.php?page=' . $page . '&action=add');  // TAO LINH CHO ADD NEW
$lblAdd    = __('Add New');
if (getParams('msg') == 1) {
    $msg .= '<div class="updated notice notice-success is-dismissible"><p>' . __('Data adjustment is successful') . '</p></div>';
}
?>
<style type="text/css">
    .column-title {
        width: 300px;
    }
</style>
<div class="wrap">
    <h2 style="font-weight: bold">
        <?php echo esc_html__($lbl); ?>
        <a href="<?php echo esc_url($linkAdd); ?>" class="add-new-h2"><?php echo esc_html__($lblAdd); ?></a>
    </h2>
    <?php echo @$msg; ?>
    <form action="" method="post" name="<?php echo $page; ?>" id="<?php echo $page; ?>">
        <?php $show_list->search_box(__('Search'), 'search_id');
        $show_list->views();
        $show_list->display(); ?>
    </form>
</div>

<script type="text/javascript">
    function confirmDelete(id) {
        var page = '<?php echo $page; ?>';
        var url = "admin.php?page=" + page + "&action=delete&id=" + id;
        if (confirm("您確定刪除這筆資料！")) {
            window.location.href = url;
        } else {
            console.log('false');
        }
    }
</script>