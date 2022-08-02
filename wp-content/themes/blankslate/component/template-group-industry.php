<?php
global $wpdb;
$table = $wpdb->prefix . 'member_industry';
$id = get_query_var('industry');
?>
<div class="group-border">
    <div class="group-title">
        <label> <?php _e("Service") ?></label>
    </div>
    <div>
        <ul class="article-list">
            <?php
            $sql = "SELECT ID, name FROM $table ORDER BY `order` DESC";
            $industryList = $wpdb->get_results($sql, ARRAY_A);
            if (!empty($industryList)) {
                foreach ($industryList as $key => $val) {
                    ?>
                    <li class="<?php echo $val['ID'] == $id ? 'select' : '' ?>">
                        <?php if ($val['ID'] == $id) { ?>
                            <label><?php echo $val['name'] ?></label> 
                        <?php } else { ?>
                            <a class="article-title" href="<?php echo home_url('member') . '/industry/' . $val['ID']; ?>">  <?php echo $val['name'] ?></a>
                        <?php } ?>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>

