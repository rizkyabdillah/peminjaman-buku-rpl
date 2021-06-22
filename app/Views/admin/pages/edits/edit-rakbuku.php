<?= $this->extend('admin/partials/index-form') ?>

<?= $this->section('form-contents') ?>
<form method="POST" action="<?= route_to('update_rakbuku', $dataset['id_rak']); ?>" class="needs-validation" novalidate="" enctype="multipart/form-data">

    <!-- CSRF Field -->
    <?= csrf_field(); ?>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="nomor_rak">Nomor Rak Buku</label>
            <input type="number" class="form-control <?= ($valid->hasError('nomor_rak')) ? 'is-invalid' : ''; ?>" name="nomor_rak" value="<?= old('nomor_rak') ? old('nomor_rak') : $dataset['nomor_rak']; ?>" placeholder="Input nomor rak buku">
            <div class="invalid-feedback">
                <?= $valid->getError('nomor_rak'); ?>
            </div>
        </div>
    </div>

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary btn-lg btn-round">
            <i class="fas fa-save"></i> Simpan
        </button>
    </div>

</form>
<?= $this->endSection(); ?>

<!-- Section CSS -->
<?= $this->section('page_css'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/assets/modules/jquery-selectric/selectric.css">
<link rel="stylesheet" href="<?= base_url() ?>/assets/modules/bootstrap-daterangepicker/daterangepicker.css">
<?= $this->endSection(); ?>


<!-- Section JS Page Modules -->
<?= $this->section('page_modules'); ?>
<script src="<?= base_url() ?>/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<script src="<?= base_url() ?>/assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<?= $this->endSection(); ?>


<!-- Section JS Page Before JS -->
<?= $this->section('page_beforejs'); ?>

<?= $this->endSection(); ?>


<!-- Section JS Page After JS -->
<?= $this->section('page_afterjs'); ?>

<?= $this->endSection(); ?>