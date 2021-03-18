<!-- JS For Automatic Set Zoom to 80% -->
<script>
    jQuery(document).ready(function($) {
        document.body.style.zoom = "80%";
    });
</script>

<!-- General JS Scripts -->
<script src="<?= base_url(); ?>/assets/modules/jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/popper.js"></script>
<script src="<?= base_url(); ?>/assets/modules/tooltip.js"></script>
<script src="<?= base_url(); ?>/assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/moment.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="<?= base_url(); ?>/assets/modules/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/sweetalert/sweetalert.min.js"></script>
<?= $this->renderSection('page_modules'); ?>

<!-- Page Specific JS File -->
<?= $this->renderSection('page_beforejs'); ?>

<!-- Template JS File -->
<script src="<?= base_url(); ?>/assets/js/scripts.js"></script>
<script src="<?= base_url(); ?>/assets/js/custom.js"></script>

<!-- Page JS Last Declaration -->
<?= $this->renderSection('page_afterjs'); ?>