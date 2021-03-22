<?= $this->extend('admin/partials/index-form') ?>

<?= $this->section('form-contents') ?>
<form method="POST" action="<?= route_to('save_buku'); ?>" class="needs-validation" novalidate="" enctype="multipart/form-data">

    <!-- CSRF Field -->
    <?= csrf_field(); ?>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="nama_buku">Nama Buku</label>
            <input type="text" class="form-control <?= ($valid->hasError('nama_buku')) ? 'is-invalid' : ''; ?>" name="nama_buku" value="<?= old('nama_buku'); ?>" placeholder="Input Nama Buku">
            <div class="invalid-feedback">
                <?= $valid->getError('nama_buku'); ?>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label>Pilih Kategori</label>
            <?php
            $data = array();
            foreach ($data_kategori as $i) {
                $data[$i['id_kategori']] = $i['nama_kategori'];
            }
            echo form_dropdown('data_kategori', $data, old('data_kategori'), 'class="form-control selectric "');
            ?>
        </div>
        <div class="form-group col-md-4">
            <label>Pilih Penerbit</label>
            <?php
            $data = array();
            foreach ($data_penerbit as $i) {
                $data[$i['id_penerbit']] = $i['nama_penerbit'];
            }
            echo form_dropdown('data_penerbit', $data, old('data_penerbit'), 'class="form-control selectric "');
            ?>
        </div>
        <div class="form-group col-md-4">
            <label>Pilih Pengarang</label>
            <?php
            $data = array();
            foreach ($data_pengarang as $i) {
                $data[$i['id_pengarang']] = $i['nama_pengarang'];
            }
            echo form_dropdown('data_pengarang', $data, old('data_pengarang'), 'class="form-control selectric "');
            ?>
        </div>
        <div class="form-group col-md-1">
            <label>Pilih Nomor Rak</label>
            <?php
            $data = array();
            foreach ($data_rak as $i) {
                $data[$i['id_rak']] = $i['nomor_rak'];
            }
            echo form_dropdown('data_rak', $data, old('data_rak'), 'class="form-control selectric "');
            ?>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="jumlah_halaman">Jumlah Halaman</label>
            <input type="number" class="form-control <?= ($valid->hasError('jumlah_halaman')) ? 'is-invalid' : ''; ?>" name="jumlah_halaman" value="<?= old('jumlah_halaman'); ?>" placeholder="Input Jumlah Halaman">
            <div class="invalid-feedback">
                <?= $valid->getError('jumlah_halaman'); ?>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="tahun_cetakan">Tahun Cetakan</label>
            <input type="number" class="form-control <?= ($valid->hasError('tahun_cetakan')) ? 'is-invalid' : ''; ?>" name="tahun_cetakan" value="<?= old('tahun_cetakan'); ?>" placeholder="Input Tahun Cetakan ex = (2021)">
            <div class="invalid-feedback">
                <?= $valid->getError('tahun_cetakan'); ?>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-1">
            <!-- <label for="pilih_gambar">Preview</label> -->
            <img src="<?= base_url() ?>/assets/images/buku/default.png" class="img-thumbnail img-preview" />
        </div>
        <div class="form-group col-md-11">
            <label for="pilih_gambar">Pilih Gambar</label>
            <input onchange="previewImg()" type="file" name="gambar" class="form-control gambar <?= ($valid->hasError('gambar')) ? 'is-invalid' : ''; ?>" placeholder="Upload Image">
            <div class="invalid-feedback">
                <?= $valid->getError('gambar'); ?>
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
<script>
    function previewImg() {
        const images = document.querySelector('.gambar ');
        const imagesPreview = document.querySelector(".img-preview");

        const readers = new FileReader();

        readers.readAsDataURL(images.files[0]);

        readers.onload = function(e) {
            imagesPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection(); ?>