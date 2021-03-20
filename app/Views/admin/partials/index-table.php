<?= $this->extend('admin/partials/master') ?>

<?= $this->section('layouts-contents') ?>


<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-header-action float-right">
                    <a href="<?= $link_add ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Tambah Data
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?= $this->renderSection('table-contents'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>