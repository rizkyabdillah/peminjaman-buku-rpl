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
        foreach ($dataset as $i) :
            $arr = array_values($i);
        ?>
            <tr>
                <?php
                for ($j = 0; $j < count($arr) - 1; $j++) :
                ?>
                    <td><?= $arr[$j] ?>
                    <?php
                endfor
                    ?>
                    <td>
                        <div class="badge badge-<?= badge($arr[count($arr) - 1]); ?>"><?= $arr[count($arr) - 1] ?></div>
                    </td>
                    <td class="text-center" style="align-content:center ;">
                        <li class="media">
                            <div class="media-cta">
                                <a href="#" onclick="detailTransaksi('<?= $arr[0]; ?>');" class="btn btn-info pl-3 pr-3" data-toggle="tooltip" data-original-title="Detail Peminjaman"><i class="fas fa-exclamation-circle"></i> </a>
                                <a href="<?= route_to('view_pengembalian', $arr[0]); ?>" class="btn btn-primary pl-3 pr-3" data-toggle="tooltip" data-original-title="Kelola Pengembalian"><i class="fas fa-th-list"></i> </a>
                                <a href="#" data-id="<?= $arr[0] ?>" class="btn btn-danger pl-3 pr-3 swal-confirm" data-toggle="tooltip" data-original-title="Hapus Transaksi">
                                    <form action="<?= route_to('delete_transaksi', $arr[0]); ?>" method="POST" id="hapus<?= $arr[0] ?>" class="">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE" />
                                    </form>
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </li>
                    </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection(); ?>




<?= $this->section('modal') ?>
<div class="modal fade in" id="detail_dialog" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header ">
                            <h4>DETAIL PEMINJAMAN</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-ascending">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">#</th>
                                            <th class="text-center" style="width: 15%;">ID</th>
                                            <th>Nama Buku</th>
                                            <th>Nama Penerbit</th>
                                            <th>Nama Pengarang</th>
                                            <th>Jumlah Halaman</th>
                                            <th>Banyak Buku</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modal_body">


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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


    function detailTransaksi(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url() . route_to('detail_transaksi') ?>",
            cache: false,
            dataType: 'JSON',
            data: {
                id_transaksi: id
            },
            success: function(data) {
                var stringhmlt = "";
                for (let i = 0; i < data.length; i++) {
                    stringhmlt +=
                        '<tr>' +
                        '<td>' + (i + 1) + '</td>' +
                        '<td>' + data[i]['id_buku'] + '</td>' +
                        '<td>' + data[i]['nama_buku'] + '</td>' +
                        '<td>' + data[i]['nama_penerbit'] + '</td>' +
                        '<td>' + data[i]['nama_pengarang'] + '</td>' +
                        '<td>' + data[i]['jumlah_halaman'] + '</td>' +
                        '<td>' + data[i]['banyak_buku'] + '</td>' +
                        '</tr>';
                }
                $('#modal_body').html(stringhmlt);
                $('#detail_dialog').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });
    }
</script>
<?= $this->endSection(); ?>