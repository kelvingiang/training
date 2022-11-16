<?php
function downloadItem($val)
{ ?>
    <div class="download-item">
        <a style=" display: block; text-decoration: none" target="_blank" href="<?php echo PART_FILE . $val['file'] ?>">
            <div class="download-item-img">
                <img src="<?php echo PART_IMAGES . 'download/' . $val['img'] ?>" />
            </div>
            <div class="download-item-title">
                <label><?php echo $val['title'] ?></label>
            </div>
        </a>
    </div>
<?php }
