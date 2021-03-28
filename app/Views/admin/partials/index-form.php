<?= $this->extend('admin/partials/master') ?>

<?= $this->section('layouts-contents') ?>


<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Form <?= $text_header_form ?></h4>
            </div>
            <div class="card-body">
                <?= $this->renderSection('form-contents'); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>