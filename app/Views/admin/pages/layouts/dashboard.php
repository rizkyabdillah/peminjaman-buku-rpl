<?= $this->extend('admin/partials/master') ?>

<?= $this->section('layouts-contents') ?>

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-book"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Buku</h4>
                </div>
                <div class="card-body">
                    10
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-user-friends"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Anggota</h4>
                </div>
                <div class="card-body">
                    42
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-book-open"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Peminjaman Aktif</h4>
                </div>
                <div class="card-body">
                    1,201
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-money-check-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Denda</h4>
                </div>
                <div class="card-body">
                    47
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-6 col-sm-6">
        <div class="card">
            <div class="card-header">
                <h4>Calendar</h4>
            </div>
            <div class="card-body">
                <div class="fc-overflow">
                    <div id="myEvent"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card">
            <div class="card-header">
                <h4 class="d-inline">Histori Terakhir</h4>
                <div class="card-header-action">
                    <a href="#" class="btn btn-primary">View All</a>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-unstyled list-unstyled-border">
                    <li class="media">
                        <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-4.png" alt="avatar">
                        <div class="media-body">
                            <div class="badge badge-pill badge-warning mb-1 float-right">Progress</div>
                            <h6 class="media-title"><a href="#">Djaja Suparman</a></h6>
                            <div class="text-small text-muted">Melakukan Peminjaman Buku <div class="bullet">
                                </div> <span class="text-primary">Now</span></div>
                        </div>
                    </li>
                    <li class="media">
                        <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-5.png" alt="avatar">
                        <div class="media-body">
                            <div class="badge badge-pill badge-info mb-1 float-right">Completed</div>
                            <h6 class="media-title"><a href="#">Alvin Riananda</a></h6>
                            <div class="text-small text-muted">Melakukan Pengembalian Buku<div class="bullet">
                                </div> 4 Min</div>
                        </div>
                    </li>
                    <li class="media">
                        <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-2.png" alt="avatar">
                        <div class="media-body">
                            <div class="badge badge-pill badge-danger mb-1 float-right">Denda</div>
                            <h6 class="media-title"><a href="#">Wahyu Andika</a></h6>
                            <div class="text-small text-muted">Melakukan Pengembalian Buku<div class="bullet">
                                </div> 8 Min</div>
                        </div>
                    </li>
                    <li class="media">
                        <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-4.png" alt="avatar">
                        <div class="media-body">
                            <div class="badge badge-pill badge-warning mb-1 float-right">Progress</div>
                            <h6 class="media-title"><a href="#">Djaja Suparman</a></h6>
                            <div class="text-small text-muted">Melakukan Peminjaman Buku <div class="bullet">
                                </div> <span class="text-primary">Now</span></div>
                        </div>
                    </li>
                    <li class="media">
                        <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-5.png" alt="avatar">
                        <div class="media-body">
                            <div class="badge badge-pill badge-info mb-1 float-right">Completed</div>
                            <h6 class="media-title"><a href="#">Alvin Riananda</a></h6>
                            <div class="text-small text-muted">Melakukan Pengembalian Buku<div class="bullet">
                                </div> 4 Min</div>
                        </div>
                    </li>
                    <li class="media">
                        <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-2.png" alt="avatar">
                        <div class="media-body">
                            <div class="badge badge-pill badge-danger mb-1 float-right">Denda</div>
                            <h6 class="media-title"><a href="#">Wahyu Andika</a></h6>
                            <div class="text-small text-muted">Melakukan Pengembalian Buku<div class="bullet">
                                </div> 8 Min</div>
                        </div>
                    </li>
                    <li class="media">
                        <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-5.png" alt="avatar">
                        <div class="media-body">
                            <div class="badge badge-pill badge-info mb-1 float-right">Completed</div>
                            <h6 class="media-title"><a href="#">Alvin Riananda</a></h6>
                            <div class="text-small text-muted">Melakukan Pengembalian Buku<div class="bullet">
                                </div> 4 Min</div>
                        </div>
                    </li>
                    <li class="media">
                        <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-2.png" alt="avatar">
                        <div class="media-body">
                            <div class="badge badge-pill badge-danger mb-1 float-right">Denda</div>
                            <h6 class="media-title"><a href="#">Wahyu Andika</a></h6>
                            <div class="text-small text-muted">Melakukan Pengembalian Buku<div class="bullet">
                                </div> 8 Min</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<!-- Section CSS -->
<?= $this->section('page_css'); ?>
<link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/fullcalendar/fullcalendar.min.css">
<?= $this->endSection(); ?>


<!-- Section JS Page Modules -->
<?= $this->section('page_modules'); ?>
<script src="<?= base_url(); ?>/assets/modules/fullcalendar/fullcalendar.min.js"></script>
<?= $this->endSection(); ?>


<!-- Section JS Page Before JS -->
<?= $this->section('page_beforejs'); ?>
<script src="<?= base_url(); ?>/assets/js/page/modules-calendar.js"></script>
<?= $this->endSection(); ?>


<!-- Section JS Page After JS -->
<?= $this->section('page_afterjs'); ?>

<?= $this->endSection(); ?>