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
                    <?= $count_buku ?>
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
                    <?= $count_anggota ?>
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
                    <?= $count_peminjaman ?>
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
                    <?= $count_denda ?>
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
                    <a href="<?= route_to('view_transaksi') ?>" class="btn btn-primary">View All</a>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-unstyled list-unstyled-border">
                    <?php
                    function badge($status)
                    {
                        switch ($status) {
                            case 'PROGRESS':
                                return 'warning';
                                break;
                            case 'SELESAI':
                                return 'primary';
                                break;
                            case 'DENDA':
                                return 'danger';
                                break;
                        }
                    }

                    function status($status)
                    {
                        switch ($status) {
                            case 'PROGRESS':
                                return 'Melakukan Peminjaman Buku';
                                break;
                            case 'SELESAI':
                                return 'Melakukan Penyelesaian Peminjaman';
                                break;
                            case 'DENDA':
                                return 'Melakukan Pengembalian Telat';
                                break;
                        }
                    }

                    function avatar($status)
                    {
                        switch ($status) {
                            case 'PROGRESS':
                                return 'avatar-4.png';
                                break;
                            case 'SELESAI':
                                return 'avatar-5.png';
                                break;
                            case 'DENDA':
                                return 'avatar-2.png';
                                break;
                        }
                    }
                    foreach ($transaksi as $i) :
                        $arr = array_values($i);
                    ?>
                        <li class="media">
                            <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/<?= avatar($arr[1]) ?>" alt="avatar">
                            <div class="media-body">
                                <div class="badge badge-pill badge-<?= badge($arr[1]) ?> mb-1 float-right"><?= $arr[1] ?></div>
                                <h6 class="media-title"><a href="#"><?= $arr[0] ?></a></h6>
                                <div class="text-small text-muted"><?= status($arr[1]) ?></div>
                            </div>
                        </li>
                    <?php
                    endforeach
                    ?>
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