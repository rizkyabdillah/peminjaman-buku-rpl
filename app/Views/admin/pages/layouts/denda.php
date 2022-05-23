<?= $this->extend('admin/partials/master') ?>

<?= $this->section('layouts-contents') ?>
<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card card-primary">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-descending">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Nama Anggota</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Banyak Buku</th>
                                <th>Total Denda</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            function badge($status)
                            {
                                switch ($status) {
                                    case 'LUNAS':
                                        return 'primary';
                                        break;
                                    case 'BELUM LUNAS':
                                        return 'danger';
                                        break;
                                }
                            }
                            foreach ($dataset as $i) :
                                $arr = array_values($i);
                            ?>
                                <tr>
                                    <?php
                                    for ($j = 0; $j < count($arr) - 1; $j++) : ?>
                                        <td><?= $arr[$j]; ?></td>
                                    <?php
                                    endfor
                                    ?>
                                    <td>
                                        <div class="badge badge-<?= badge($arr[count($arr) - 1]); ?>"><?= $arr[count($arr) - 1] ?></div>
                                    </td>
                                    <td class="text-center" style="align-content:center ;">
                                        <li class="media">
                                            <div class="media-cta">
                                                <a href="#" onclick="onUbah('<?= $arr[0]; ?>');" class="btn btn-warning pl-3 pr-3" data-toggle="tooltip" data-original-title="Ubah Pembayaran"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" data-id="<?= $arr[0]; ?>" class="btn btn-danger pl-3 pr-3 swal-confirm" data-toggle="tooltip" data-original-title="Hapus Denda">
                                                    <form action="<?= route_to('delete_denda', $arr[0]); ?>" method="POST" id="hapus<?= $arr[0]; ?>" class="">
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
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('modal') ?>
<div class="modal fade in" id="dialog" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card card-primary">
                        <form method="POST" action="<?= route_to('update_denda') ?>" class="needs-validation" novalidate>
                            <div class="card-header ">
                                <h4>Ubah Pembayaran</h4>
                                <div class="card-header-action">
                                    <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Total Denda</label>
                                        <input type="hidden" name="id_denda" id="id_denda">
                                        <input type="text" class="form-control" id="total_denda" name="total_denda" readonly>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Bayar</label>
                                        <input type="number" class="form-control" id="total_bayar" name="total_bayar">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Kurang Bayar</label>
                                        <input type="text" class="form-control" id="kurang_bayar" value="0" readonly>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Kembalian</label>
                                        <input type="text" class="form-control" id="kembalian" readonly>
                                    </div>
                                </div>


                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary btn-lg btn-round">
                                    <i class="fas fa-save"></i> Ubah
                                </button>
                            </div>
                        </form>
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
    let total_denda = 0;

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

    function onUbah(val) {
        $.ajax({
            type: "POST",
            url: "<?= base_url() . route_to('datadenda') ?>",
            cache: false,
            dataType: 'JSON',
            data: {
                id_denda: val
            },
            success: function(data) {
                total_denda = data.total_denda;
                $('#total_denda').val(data.total_denda);
                $('#id_denda').val(data.id_denda);
                if (Number(data.total_bayar) > 0) {
                    $('#total_bayar').val(data.total_bayar);
                }
                if (Number(data.total_bayar) > Number(data.total_denda)) {
                    $('#kembalian').val("Rp. " + (Number(data.total_bayar) - Number(data.total_denda)));
                } else {
                    $('#kurang_bayar').val("Rp. " + (Number(data.total_denda) - Number(data.total_bayar)));
                }
                $('#dialog').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });
    }

    $(document).on("input", "#total_bayar", function(e) {
        let value = $(this).val();
        if (Number(value) >= Number(total_denda)) {
            $('#kembalian').val("Rp. " + (Number(value) - Number(total_denda)));
            $('#kurang_bayar').val("0");
        } else {
            $('#kurang_bayar').val("Rp. " + (Number(total_denda) - Number(value)));
            $('#kembalian').val("0");
        }
    });
</script>
<?= $this->endSection(); ?>