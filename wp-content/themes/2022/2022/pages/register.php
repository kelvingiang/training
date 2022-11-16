<?php
/*
  Template Name: Register Page
 */
?>

<?php
ob_start();  // neu bao loi PHP Warning: Cannot modify header information – headers already sent by
get_header();
?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] != '') {
            get_template_part('templates/template', 'profile');
        } else {
            get_template_part('templates/template', 'register-student');
        }
        ?>
    </div>
</div>
<?php
get_footer();
ob_flush();   // neu bao loi PHP Warning: Cannot modify header information – headers already sent by
