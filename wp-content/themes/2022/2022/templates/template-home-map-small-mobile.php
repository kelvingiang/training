<div class="row map-small-mobile">
    <div class="col-lg-6 col-xl-6 col-md-12 map-small-mobile-branch" style="margin-top:2rem">
        <?php get_template_part('templates/template', 'home-branch-slider-mobile'); ?>
    </div>
    <div class=" col-lg-6 col-xl-6 col-md-12 map-small-map">

        <div class="map">
            <img class="map-img" src="<?php echo PART_IMAGES . 'mapvietnam/vietnammap.jpg' ?>" />

            <div class="branch-local branch-bacninh">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="branch-local branch-hanoi">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="branch-local branch-haiphong">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="branch-local branch-thaibinh">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="branch-local branch-hatinh">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="branch-local branch-danang">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="branch-local branch-lamdong">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="branch-local branch-dongnai">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="branch-local branch-hcm">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="branch-local branch-vungtau">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="branch-local branch-binhduong">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="branch-local branch-tayninh">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <div class="branch-local branch-longan">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
        </div>

        <div class='lienket'>
            <ul class="map-small-mobile-branch-link">
                <li>
                    <a href="http://www.ctcvnbn.org/" target="blank" data-id="branch-bacninh">
                        <?php _e('Branch Bac Ninh') ?>
                    </a>

                </li>
                <li>
                    <a href="http://ctcvn-hanoi.com/" target="blank" data-id="branch-hanoi">
                        <?php _e('Branch Ha Noi') ?>
                    </a>
                </li>
                <li>
                    <a href="http://www.ctcvnhp.org/" target="blank" data-id="branch-haiphong">
                        <?php _e('Branch Hai Phong') ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo home_url('branch') . '/b/0360'; ?>" data-id="branch-thaibinh">
                        <?php _e('Branch Thai Binh') ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo home_url('branch') . '/b/0390'; ?>" data-id="branch-hatinh">
                        <?php _e('Branch Ha Tinh') ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo home_url('branch') . '/b/0511'; ?>" data-id="branch-danang">
                        <?php _e('Branch Da Nang') ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo home_url('branch') . '/b/0630'; ?>" data-id="branch-lamdong">
                        <?php _e('Branch Lam Dong') ?>
                    </a>
                </li>
                <li>
                    <a href="https://dongnaitw.com/" target="blank" data-id="branch-dongnai">
                        <?php _e('Branch Dong Nai') ?>
                    </a>
                </li>
                <li>
                    <a target="blank" href="http://ctcvnhcmc.vn/" data-id="branch-hcm">
                        <?php _e('Branch Ho Chi Minh') ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo home_url('branch') . '/b/0081'; ?>" data-id="branch-hcm">
                        <?php _e('Branch Tan Thuan') ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo home_url('branch') . '/b/0640'; ?>" data-id="branch-vungtau">
                        <?php _e('Branch Vung Tau') ?>
                    </a>
                </li>
                <li>
                    <a href="https://btbvn.vn/" target="blank" data-id="branch-binhduong">
                        <?php _e('Branch Binh Duong') ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo home_url('branch') . '/b/0660'; ?>" data-id="branch-tayninh">
                        <?php _e('Branch Tay Ninh') ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo home_url('branch') . '/b/0720'; ?>" data-id="branch-longan">
                        <?php _e('Branch Long An') ?>
                    </a>
                </li>
            </ul>

        </div>
    </div>

</div>

<script>
    jQuery(document).ready(function() {
        jQuery('.map-small-branch-link li a').on({
            mouseenter: function() {
                var branch = '.' + jQuery(this).attr('data-id');
                jQuery(branch).addClass('branch-show');
                jQuery(branch).removeClass('branch-close');

            },
            mouseleave: function() {
                var branch = '.' + jQuery(this).attr('data-id');
                jQuery(branch).addClass('branch-close');
                jQuery(branch).removeClass('branch-show');
            }
        })

    })
</script>