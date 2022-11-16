<style>
    .map {
        background-repeat: no-repeat, repeat;
        background-image: url(" <?php echo PART_IMAGES . 'mapvietnam/vietnam-map-' . $_SESSION['languages'] . '.png' ?> ");
        height: 783px;
        width: 500px;
        background-position: center;
        /* Center the image */
        background-repeat: no-repeat;
        /* Do not repeat the image */
        background-size: cover;
        /* Resize the background image to cover the entire container */
        position: relative;
    }
</style>
<div id="map-space">
    <div class="map">

        <div class="branch bac-ninh">
            <a class="branch-link" href="http://www.ctcvnbn.org/" target="blank">
                <?php _e('Branch Bac Ninh') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_bacninh.png'  ?>" />
            <div class="branch-content" style=" visibility: hidden">
            </div>
        </div>

        <div class="branch ha-noi">
            <a class="branch-link" href="http://ctcvn-hanoi.com/" target="blank">
                <?php _e('Branch Ha Noi') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_hanoi.png'  ?>" />
            <div class="branch-content" style="visibility: hidden"></div>
        </div>

        <div class="branch hai-phong">
            <a class="branch-link" href="http://www.ctcvnhp.org/" target="blank">
                <?php _e('Branch Hai Phong') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_haiphong.png'  ?>" />
            <div class="branch-content" style="visibility: hidden"></div>
        </div>

        <div class="branch thai-binh">
            <a class="branch-link" href="<?php echo home_url('branch') . '/b/0360'; ?>">
                <?php _e('Branch Thai Binh') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_thaibinh.png'  ?>" />
            <div class="branch-content" style="visibility: hidden"></div>
        </div>

        <div class="branch ha-tinh">
            <a class="branch-link" href="<?php echo home_url('branch') . '/b/0390'; ?>">
                <?php _e('Branch Ha Tinh') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_hatinh.png'  ?>" />
            <div class="branch-content" style="visibility: hidden"></div>
        </div>

        <div class="branch da-nang">
            <a class="branch-link" href="<?php echo home_url('branch') . '/b/0511'; ?>">
                <?php _e('Branch Da Nang') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_danang.png'  ?>" />
            <div class="branch-content" style="visibility: hidden"></div>
        </div>

        <div class="branch lam-dong">
            <a class="branch-link" href="<?php echo home_url('branch') . '/b/0630'; ?>">
                <?php _e('Branch Lam Dong') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_lamdong.png'  ?>" />
            <div class="branch-content" style="visibility: hidden"></div>
        </div>

        <div class="branch dong-nai">
            <a class="branch-link" href="https://dongnaitw.com/" target="blank">
                <?php _e('Branch Dong Nai') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_dongnai.png'  ?>" />
            <div class="branch-content" style="visibility: hidden"></div>
        </div>

        <div class="branch ho-chi-minh">
            <a class="branch-link" target="blank" href="http://ctcvnhcmc.vn/">
                <?php _e('Branch Ho Chi Minh') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_hcm.png'  ?>" />
            <div class="branch-content" style="visibility: hidden"></div>
        </div>

        <div class="branch tan-thuan">
            <a class="branch-link" href="<?php echo home_url('branch') . '/b/0081'; ?>">
                <?php _e('Branch Tan Thuan') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_tanthuan.png'  ?>" />
            <div class="branch-content" style="visibility: hidden"></div>
        </div>

        <div class="branch vung-tau">
            <a class="branch-link" href="<?php echo home_url('branch') . '/b/0640'; ?>">
                <?php _e('Branch Vung Tau') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_vungtau.png'  ?>" />
            <div class="branch-content" style="visibility: hidden"></div>
        </div>

        <div class="branch <?php echo $_SESSION['languages']  == 'cn' ? 'binh-duong' : 'binh-duong-vn' ?>">
            <a class="branch-link show-right" href="https://btbvn.vn/" target="blank">
                <?php _e('Branch Binh Duong') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_binhduong.png'  ?>" />
            <div class="branch-content branch-content-left" style="visibility: hidden"></div>
        </div>

        <div class="branch <?php echo $_SESSION['languages']  == 'cn' ? 'tay-ninh' : 'tay-ninh-vn' ?>">
            <a class="branch-link show-right" href="<?php echo home_url('branch') . '/b/0660'; ?>">
                <?php _e('Branch Tay Ninh') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_tayninh.png'  ?>" />
            <div class="branch-content branch-content-left" style="visibility: hidden"></div>
        </div>

        <div class="branch <?php echo $_SESSION['languages']  == 'cn' ? 'long-an' : 'long-an-vn' ?>">
            <a class="branch-link show-right" href="<?php echo home_url('branch') . '/b/0720'; ?>">
                <?php _e('Branch Long An') ?>
            </a>
            <img class="branch-img" src="<?php echo PART_IMAGES . 'logos/logo_longan.png'  ?>" />
            <div class="branch-content branch-content-left" style="visibility: hidden"></div>
        </div>
    </div>
</div>

<script>
    var branchLink = document.querySelectorAll(".branch-link");
    branchLink.forEach(function(e) {
        e.addEventListener("mouseenter", function() {
            // cau dung de show phan noi dung chi tiet phan hoi
            //this.nextElementSibling.nextElementSibling.style.visibility = "visible";

            // tam thoi an noi dung ghi chi tiet hoi
            this.nextElementSibling.nextElementSibling.style.visibility = "hidden";

            var hasShowRight = this.classList.contains('show-right');
            if (hasShowRight) {
                this.nextElementSibling.nextElementSibling.classList.add('showRight');
                this.nextElementSibling.nextElementSibling.classList.remove('closeRight');
                this.nextElementSibling.classList.add('show');
                this.nextElementSibling.classList.remove('close');
            } else {
                this.nextElementSibling.nextElementSibling.classList.add('show');
                this.nextElementSibling.nextElementSibling.classList.remove('close');
                this.nextElementSibling.classList.add('show');
                this.nextElementSibling.classList.remove('close');
            }

        });

        e.addEventListener("mouseleave", function() {
            var hasShowRight = this.classList.contains('show-right');
            if (hasShowRight) {
                this.nextElementSibling.nextElementSibling.classList.add('closeRight');
                this.nextElementSibling.nextElementSibling.classList.remove('showRight');
                this.nextElementSibling.classList.add('close');
                this.nextElementSibling.classList.remove('show');
            } else {
                this.nextElementSibling.nextElementSibling.classList.add('close');
                this.nextElementSibling.nextElementSibling.classList.remove('show');
                this.nextElementSibling.classList.add('close');
                this.nextElementSibling.classList.remove('show');
            }

            setTimeout(function() {
                e.nextElementSibling.nextElementSibling.style.visibility = "hidden";
            }, 500);
        });
    });
</script>