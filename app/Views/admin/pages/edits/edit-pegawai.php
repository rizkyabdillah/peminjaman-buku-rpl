<?= $this->extend('admin/partials/index-form') ?>

<?= $this->section('form-contents') ?>
<form method="POST" action="<?= route_to('update_pegawai', $dataset['id_pegawai']); ?>" class="needs-validation" novalidate="" enctype="multipart/form-data">

    <!-- CSRF Field -->
    <?= csrf_field(); ?>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="nama_pegawai">Nama Pegawai</label>
            <input type="text" class="form-control <?= ($valid->hasError('nama_pegawai')) ? 'is-invalid' : ''; ?>" name="nama_pegawai" value="<?= old('nama_pegawai') ? old('nama_pegawai') : $dataset['nama_pegawai']; ?>" placeholder="Input Nama Pegawai">
            <div class="invalid-feedback">
                <?= $valid->getError('nama_pegawai'); ?>
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
            echo form_dropdown('jenis_kelamin', $data, old('jenis_kelamin') ? old('jenis_kelamin') : $dataset['jenis_kelamin'], 'class="form-control selectric "');
            ?>
        </div>
        <div class="form-group col-md-4">
            <label for="no_telp">Nomor Telepon</label>
            <input type="number" class="form-control <?= ($valid->hasError('no_telp')) ? 'is-invalid' : ''; ?>" name="no_telp" value="<?= old('no_telp') ? old('no_telp') : $dataset['nomor_telpon']; ?>" placeholder="Input Nomor Telpon">
            <div class="invalid-feedback">
                <?= $valid->getError('no_telp'); ?>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="username">Username</label>
            <input type="text" class="form-control <?= ($valid->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" value="<?= old('username') ? old('username') : $dataset['username']; ?>" placeholder="Input Username">
            <div class="invalid-feedback">
                <?= $valid->getError('username'); ?>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control <?= ($valid->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" value="<?= old('password'); ?>" placeholder="Input Password">
            <div class="invalid-feedback">
                <?= $valid->getError('password'); ?>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="re_password">Ulangi Password</label>
            <input type="password" class="form-control <?= ($valid->hasError('re_password')) ? 'is-invalid' : ''; ?>" name="re_password" placeholder="Input Password Kembali">
            <div class="invalid-feedback">
                <?= $valid->getError('re_password'); ?>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control <?= ($valid->hasError('alamat')) ? 'is-invalid' : ''; ?>"> <?= old('alamat') ? old('alamat') : $dataset['alamat']; ?></textarea>
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
<?= $this->endSection(); ?>


<!-- Section JS Page Modules -->
<?= $this->section('page_modules'); ?>
<script src="<?= base_url() ?>/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<?= $this->endSection(); ?>


<!-- Section JS Page Before JS -->
<?= $this->section('page_beforejs'); ?>

<?= $this->endSection(); ?>


<!-- Section JS Page After JS -->
<?= $this->section('page_afterjs'); ?>

<?= $this->endSection(); ?>