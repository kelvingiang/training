<?php
/*
  Template Name: Join
 */
?>
<?php get_header(); ?>

<div class="row" style="padding-top: 30px" >
    <div class="first-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
      <?php get_sidebar(); ?>
    </div>
    <div class="second-space col-lg-9 col-md-8 col-sm-12 col-xs-12">
        <div class="group-border">
            <div class="group-title">
                <label><?php _e('Join The Association') ?></label>
            </div>
            <div style="padding: 10px">
                <div style="text-align: right">
                    <a class="downlink"
                       id="downlink"
                       download
                       title="<?php echo __('Click can download join the association file') ?>"
                       href="<?php echo PART_FILE . 'join-the-association.pdf' ?>"> <h4><i class="fa fa-file-pdf-o"> </i> <?php _e('Click Download Join The Association file'); ?></h4></a>
                </div>
                <div>
                    <?php echo get_post_meta('1', '_info_apply', TRUE); ?>
                </div>
            </div>
            <div>
                
            </div>
        </div>
    </div>
      <div class="last-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
     <?php get_sidebar('mobile'); ?>
    </div>
</div>
<script type="text/javascript">
 //   jQuery(document).ready(function () {
        jQuery(function () {
            jQuery('#downlink').tooltip();
        }
 //   });
</script>

<?php get_footer(); ?>