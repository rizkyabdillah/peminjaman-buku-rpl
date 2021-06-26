<?= $this->extend('admin/partials/index-table') ?>

<?= $this->section('table-contents') ?>
<table class="table table-striped" id="table-0">
    <thead>
        <tr>
            <th class="text-center" style="width: 15%;">ID</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Kembali</th>
            <th>Nama Anggota</th>
            <th>Total Buku</th>
            <th>Status</th>
            <th class="text-center" style="width: 18%;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php //foreach ($dataset as $i) :
        // $arr = array_values($i);
        ?>
        <tr>
            <?php
            // for ($j = 0; $j < count($arr); $j++) :
            ?>
            <td>123456789012</td>
            <td>2021-08-21 11:02:11</td>
            <td>2021-08-21 11:02:11</td>
            <td>Samsul Arif</td>
            <td>120</td>
            <td>
                <div class="badge badge-info">Completed</div>
            </td>
            <?php
            // endfor
            ?>
            <td class="text-center" style="align-content:center ;">
                <li class="media">
                    <div class="media-cta">
                        <a href="<?= route_to('view_edit_rakbuku', 0); ?>" class="btn btn-info pl-3 pr-3" data-toggle="tooltip" data-original-title="Detail Peminjaman"><i class="fas fa-exclamation-circle"></i> </a>
                        <a href="<?= route_to('view_edit_rakbuku', 0); ?>" class="btn btn-primary pl-3 pr-3" data-toggle="tooltip" data-original-title="Kelola Pengembalian"><i class="fas fa-th-list"></i> </a>
                        <a href="#" data-id="<?= 0 ?>" class="btn btn-danger pl-3 pr-3 swal-confirm" data-toggle="tooltip" data-original-title="Hapus Transaksi">
                            <form action="<?= route_to('delete_rakbuku', 0); ?>" method="POST" id="hapus<?= 0 ?>" class="">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE" />
                            </form>
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </li>
            </td>
        </tr>
        <?php //endforeach 
        ?>
    </tbody>
</table>

<?= $this->endSection(); ?>

<!-- Section CSS -->
<?= $this->section('page_css'); ?>
<link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/datatables/datatables.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
<?= $this->endSection(); ?>


<!-- Section JS Page Modules -->
<?= $this->section('page_modules'); ?>
<script src="<?= base_url(); ?>/assets/modules/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<?= $this->endSection(); ?>


<!-- Section JS Page Before JS -->
<?= $this->section('page_beforejs'); ?>
<script src="<?= base_url(); ?>/assets/js/page/modules-datatables.js"></script>
<?= $this->endSection(); ?>


<!-- Section JS Page After JS -->
<?= $this->section('page_afterjs'); ?>
<script>
    $(document).on("click", ".swal-confirm", function(e) {
        var id = $(this).data('id');
        swal({
                title: 'Apakah kamu yakin?',
                text: 'Disaat kamu menghapus, data yang terhapus tidak dapat dikembalikan lagi!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#hapus'.concat(id)).submit();
                }
            });
    });

    <?php if (session()->getFlashData('pesan')) : ?>
        swal('Sukses', '<?= session()->getFlashData('pesan'); ?>', 'success', {
            buttons: false,
            timer: 1200,
        });
    <?php endif ?>
</script>
<?= $this->endSection(); ?>