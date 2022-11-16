  <?php wp_footer(); ?>


  <script>
      jQuery(document).ready(function() {
          jQuery('.language-item').on("click", function() {
              var language = jQuery(this).attr("data-id");

              jQuery.ajax({
                  url: '<?php echo get_template_directory_uri() . '/ajax/change_languages.php' ?>',
                  dataType: 'json',
                  type: 'post',
                  data: {
                      type: language
                  },
                  success: function(res) {
                      if (res.status === 'ok') {
                          //window.location = location.href;
                          //location.reload();
                          // window.location = 'http://localhost/digiwin';
                          window.location = '<?php echo get_option('home') ?>';
                      }
                  }
              });
          });

          //Upscroll HIEN MENU TOP HEADER , DOWNSCROLL AN MENU TOP
          // PHAI CHEN THEM A CALSS BOOSTREP
          // jQuery('.navbar-fixed-top').autoHidingNavbar();
      })



      // back to top
      jQuery(function() {
          jQuery(window).scroll(function() {
              if (jQuery(this).scrollTop() > 100) {
                  jQuery("#back-top").fadeIn("fast");
              } else {
                  jQuery("#back-top").fadeOut(1500);
              }
          });
          // scroll body to 0px on click
          jQuery("#back-top").click(function() {
              jQuery("body,html").stop(false, false).animate({
                      scrollTop: 0,
                  },
                  1000
              );
              return false;
          });
      });

      // HIEN THI MOBILE MENU ========================
      jQuery('#mobile-menu-icon').on('click', function(e) {
          var ss = jQuery('#mobile-menu-content').hasClass('show-nav');
          if (!ss) {
              jQuery('#mobile-menu-content').addClass('show-nav');
              jQuery('#mobile-menu-content').removeClass('close-nav');
          } else {
              jQuery('#mobile-menu-content').addClass('close-nav');
              jQuery('#mobile-menu-content').removeClass('show-nav');
          }
      })

      jQuery('.menu-item-has-children a').on('click', function(e) {
          jQuery(this).siblings('.sub-menu').slideToggle('slow');

      });
  </script>


  <!--  KHOI TAO VIEC CHAY SLIDER -->
  <script type="text/javascript" language="javascript">
      jQuery(document).ready(function() {
          jQuery('.box_skitter_large').skitter({
              thumbs: false,
              theme: 'Minimalist',
              numbers_align: 'center',
              numbers: false,
              progressbar: false,
              dots: false,
              navigation: false,
              preview: false,
              interval: 8000 // thoi gian chuyen hinh]
          });
      });


      var prevScrollpos = window.pageYOffset;
      window.onscroll = function() {
          // PHAN AN HIEN MENU 
          // KIEM TRA HEADER KHAC NONE MOI THUC HIEN
          if (jQuery('#header').css('display') !== 'none') {
              menuAnimation();
          }

          // PHAN SHOW HINH ANH KHI RE CHUOT XUONG TOI
          if (document.querySelector('.animation-item')) {
              Animation_show();
          }


          if (document.querySelector('.scroll-show-horizontal')) {
              func_show_horizontal();
          }


          if (document.querySelector('#supervisor-slider')) {
              func_remove_behind_class();
          }

          // PHAN AN HIEN HEADER TRONG MOBILE STYLE
          var currentScrollPos = window.pageYOffset;
          if (prevScrollpos > currentScrollPos) {
              document.getElementById("mobile-header").style.top = "0";
          } else {
              document.getElementById("mobile-header").style.top = "-320px";
          }
          prevScrollpos = currentScrollPos;
      }
  </script>

  <script>
      var MyanimationElements = document.querySelectorAll(".animation-item");
      // TAO HIEU UNG KHI CUON NOI DUNG TRAN WEB
      function myCheck1(element) {
          // LAY VI TRI TOP VA BOTTOM CUA ELEMENT
          var rect = element.getClientRects()[0];
          // XAC DINH DO CAO CUA MAN HINH
          var heightScreen = window.innerHeight;

          if (!(rect.bottom < 0 || rect.top > heightScreen)) {
              element.classList.add("animation-show");
          }
      }


      function Animation_show() {
          // LAY TAT CA CAC DOI TUONG CO CLASS LA .show-on-scroll
          //var animationElements = document.querySelectorAll('.show-on-scroll')
          // CHAY VONG LAP DE THEM CLASS
          MyanimationElements.forEach((el) => {
              myCheck1(el);
          });
      }




      function func_remove_behind_class(element) {

          var element = document.getElementById("supervisor-slider");

          element.classList.remove('behind-space');

      }

      if (window.matchMedia("(max-width: 992px)").matches) {
          const element = document.getElementById('map-computer');
          element.remove();

      } else {
          const element = document.getElementById('map-mobile');
          element.remove();

      }
  </script>

  </body>

  </html>