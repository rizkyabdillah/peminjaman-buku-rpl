<?= $this->extend('admin/partials/index-form') ?>

<?= $this->section('form-contents') ?>
<form method="POST" action="<?= route_to('update_kategori', $dataset['id_kategori']); ?>" class="needs-validation" novalidate="" enctype="multipart/form-data">

    <!-- CSRF Field -->
    <?= csrf_field(); ?>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="nama_buku">Nama Kategori</label>
            <input type="text" class="form-control <?= ($valid->hasError('nama_kategori')) ? 'is-invalid' : ''; ?>" name="nama_kategori" value="<?= old('nama_kategori') ? old('nama_kategori') : $dataset['nama_kategori']; ?>" placeholder="Input kategori">
            <div class="invalid-feedback">
                <?= $valid->getError('nama_kategori'); ?>
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