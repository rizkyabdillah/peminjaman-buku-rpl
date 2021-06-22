<?= $this->extend('admin/partials/index-form') ?>

<?= $this->section('form-contents') ?>
<form method="POST" action="<?= route_to('save_penerbit'); ?>" class="needs-validation" novalidate="" enctype="multipart/form-data">

    <!-- CSRF Field -->
    <?= csrf_field(); ?>

    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="nama_penerbit">Nama Penerbit</label>
            <input type="text" class="form-control <?= ($valid->hasError('nama_penerbit')) ? 'is-invalid' : ''; ?>" name="nama_penerbit" value="<?= old('nama_penerbit'); ?>" placeholder="Input Nama Penerbit">
            <div class="invalid-feedback">
                <?= $valid->getError('nama_penerbit'); ?>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="no_telp">Nomor Telepon Penerbit</label>
            <input type="number" class="form-control <?= ($valid->hasError('no_telp')) ? 'is-invalid' : ''; ?>" name="no_telp" value="<?= old('no_telp'); ?>" placeholder="Input Nomor Telepon">
            <div class="invalid-feedback">
                <?= $valid->getError('no_telp'); ?>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="alamat">Alamat Penerbit</label>
            <textarea name="alamat" class="form-control <?= ($valid->hasError('alamat')) ? 'is-invalid' : ''; ?>"><?= old('alamat'); ?></textarea>
            <div class="invalid-feedback">
                <?= $valid->getError('alamat'); ?>
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

<?= $this->endSection(); ?>


<!-- Section JS Page Modules -->
<?= $this->section('page_modules'); ?>

<?= $this->endSection(); ?>


<!-- Section JS Page Before JS -->
<?= $this->section('page_beforejs'); ?>

<?= $this->endSection(); ?>


<!-- Section JS Page After JS -->
<?= $this->section('page_afterjs'); ?>

<?= $this->endSection(); ?>