<div id="header-logo">
    <a href="<?php echo home_url() ?>">
        <img src="<?php echo PART_IMAGES . 'logoctcvn.png' ?>" alt="ctcvn_logo" title="ctcvn_logo" />
    </a>
    <label class="company-name-cn">
        <?php _e('THE COUNCIL OF TAIWANSE CHAMBERS OF COMMERCE IN VIETNAM') ?>
    </label>
    <label class="company-name-en">
        THE COUNCIL OF TAIWANESE CHAMBERS OF COMMERCE IN VIETNAM
    </label>
</div>

<script>
    var animationElements = document.querySelectorAll("#header-logo");
    // TAO HIEU UNG KHI CUON NOI DUNG TRAN WEB
    function myCheck(element) {
        // LAY VI TRI TOP VA BOTTOM CUA ELEMENT
        var rect = element.getClientRects()[0];
        // XAC DINH DO CAO CUA MAN HINH
        var heightScreen = window.innerHeight;

        if (rect.bottom < 0) {
            document.querySelector('.show-on-scroll').classList.add("start");
        } else {
            document.querySelector('.show-on-scroll').classList.remove("start");
        }
    }

    function menuAnimation() {
        // LAY TAT CA CAC DOI TUONG CO CLASS LA .show-on-scroll
        //var animationElements = document.querySelectorAll('.show-on-scroll')
        // CHAY VONG LAP DE THEM CLASS
        animationElements.forEach((el) => {
            myCheck(el);
        });
        // animationElements.myCheck();
    }

    //window.onscroll = checkAnimation;
</script>