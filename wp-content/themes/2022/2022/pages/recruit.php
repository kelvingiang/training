<?php
/*
  Template Name: Post  Recruit  Page
 */

get_header();

//==================================================================
?>

<div class="row">
    <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">
        <!-- //================================================ -->

        <?php
        if ($_GET['dt'] === '3' || !isset($_GET['dt']) || $_GET['dt'] !== '4') {
            get_template_part('templates/template', 'ungtuyen');
        } elseif ($_GET['dt'] === '4') {
            get_template_part('templates/template', 'dangtuyen');
        }
        ?>

    </div>

    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12">
        <?php
        if ($_GET['dt'] === '3' || !isset($_GET['dt']) || $_GET['dt'] !== '4') {
            get_template_part('templates/template', 'ungtuyen-list');
        } elseif ($_GET['dt'] === '4') {
            get_template_part('templates/template', 'dangtuyen-list');
        }
        ?>
    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php _e('刪除資料', 'suite'); ?></h4>
                <button type="button" class="close" data-bs-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>

            <div class="modal-body">
                <p> <?php _e('您是否要刪除這行資料', 'suite'); ?></p>
                <p class="debug-url"></p>
            </div>

            <div class="modal-footer">
                <div class="btn-space">
                    <button type="button" class="btn-my" data-bs-dismiss="modal">
                        <?php _e('Cancel', 'suite'); ?>
                    </button>
                    <a class="btn-my btn-ok"><?php _e('Delete', 'suite'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function() {
        jQuery('#confirm-delete').on('show.bs.modal', function(e) {
            jQuery(this).find('.btn-ok').attr('href', jQuery(e.relatedTarget).data('href'));
        });
    });
</script>

<?php
get_footer();
