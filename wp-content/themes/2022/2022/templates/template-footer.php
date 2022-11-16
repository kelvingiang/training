</div>
</div> <!-- end coontaineer -->
<?php if (!is_page('check-in')) { ?>
    <div id="back-top-wrapper">
        <a id="back-top">
            <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
        </a>
    </div>

    <div id="footer">
        <div class="row">

            <div class=" col-xl-9 col-lg-8 col-md-12 col-sm-12 footer-contact">
                <div>
                    <i class="fa fa-map-marker" aria-hidden="true"></i> : CR2-15. 107 Tôn Dật Tiên, Phường Tân Phú, Q7, TPHCM
                </div>
                <div>
                    <i class="fa fa-phone" aria-hidden="true"></i> : 84-28-5413.8348
                </div>
                <div>
                    <i class="fa fa-envelope" aria-hidden="true"></i> : ctcvn@ctcvn.vn
                </div>
            </div>

            <div class="  col-xl-3 col-lg-4 col-md-12 col-sm-12 footer-counter">
                <?php
                require_once(DIR_CLASS . 'online-counter.php');
                $online = new DT_Online_counter();
                ?>

                <div>
                    <div>在線人數 :&nbsp; </div>
                    <div class="footer-counter-number">
                        <?php echo $online->online(); ?>
                    </div>
                </div>

                <div>
                    <div>瀏覽人數 :&nbsp; </div>
                    <div class="footer-counter-number">
                        <?php
                        $num = $online->total();
                        echo number_format($num);
                        ?>
                    </div>
                </div>
            </div>

            <div class="  col-xl-12 col-lg-12 col-md-12 col-sm-12 footer-copyright">
                <a rel="author" href="https://digiwin.com.vn" target="_blank">
                    &copy; - 2015 Design by Digiwin Software (Vietnam) Co., Ltd
                </a>
            </div>




        </div>
    </div>

<?php } ?>