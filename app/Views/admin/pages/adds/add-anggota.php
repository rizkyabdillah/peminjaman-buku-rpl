<?= $this->extend('admin/partials/index-form') ?>

<?= $this->section('form-contents') ?>
<form method="POST" action="<?= route_to('save_anggota'); ?>" class="needs-validation" novalidate="" enctype="multipart/form-data">

    <!-- CSRF Field -->
    <?= csrf_field(); ?>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="nama_anggota">Nama Anggota</label>
            <input type="text" class="form-control <?= ($valid->hasError('nama_anggota')) ? 'is-invalid' : ''; ?>" name="nama_anggota" value="<?= old('nama_anggota'); ?>" placeholder="Input Nama Anggota">
            <div class="invalid-feedback">
                <?= $valid->getError('nama_anggota'); ?>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Pilih Jenis Kelamin</label>
            <?php
            $data = array(
                'L' => 'Laki - Laki',
                'P' => 'Perempuan'
            );
            echo form_dropdown('jenis_kelamin', $data, old('jenis_kelamin'), 'class="form-control selectric "');
            ?>
        </div>
        <div class="form-group col-md-4">
            <label for="no_telp">Nomor Telepon</label>
            <input type="number" class="form-control <?= ($valid->hasError('no_telp')) ? 'is-invalid' : ''; ?>" name="no_telp" value="<?= old('no_telp'); ?>" placeholder="Input Nomor Telpon">
            <div class="invalid-feedback">
                <?= $valid->getError('no_telp'); ?>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="tanggal_gabung">Tanggal Bergabung</label>
            <input type="text" class="form-control datepicker <?= ($valid->hasError('tanggal_gabung')) ? 'is-invalid' : ''; ?>" name="tanggal_gabung" value="<?= old('tanggal_gabung'); ?>" placeholder="Pilih Tanggal">
            <div class="invalid-feedback">
                <?= $valid->getError('tanggal_gabung'); ?>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="alamat">Alamat</label>
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