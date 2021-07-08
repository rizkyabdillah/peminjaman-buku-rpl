<?= $this->extend('admin/partials/master') ?>

<?= $this->section('layouts-contents') ?>


<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card card-info">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Nama Anggota</label>
                        <input type="text" class="form-control" id="id_transaksi" value="<?= $dataset['data_anggota']['nama_anggota'] ?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Nomor Transaksi</label>
                        <input type="text" class="form-control" id="id_transaksi" value="<?= $dataset['data_transaksi']['id_transaksi'] ?>" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tanggal Pinjam</label>
                        <input type="text" class="form-control" id="tanggal_pinjam" value="<?= $dataset['data_transaksi']['tanggal_peminjaman'] ?>" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tanggal Kembali</label>
                        <input type="text" class="form-control" id="tanggal_kembali" value="<?= $dataset['data_transaksi']['tanggal_harus_kembali'] ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-12">
        <div class="card card-info">
            <div class="card-body">

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Pilih Buku</label>
                        <?php
                        $data_buku = array('' => '=== Pilih ===');
                        foreach ($dataset['data_buku'] as $i) {
                            $data_buku[$i['id_buku']] = $i['id_buku'] . " - " . $i['nama_buku'];
                        }
                        echo form_dropdown('data_buku', $data_buku, '', 'class="form-control select2" id="data_buku"');
                        ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Nama Buku</label>
                        <input type="text" class="form-control" id="nama_buku" value="" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Nama Penerbit</label>
                        <input type="text" class="form-control" id="nama_penerbit" value="" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Nama Pengarang</label>
                        <input type="text" class="form-control" id="nama_pengarang" value="" readonly>
                    </div>
                    <div class="form-group col-md-1">
                        <label>Banyak Buku</label>
                        <select class="form-control" id="banyak_buku" disabled>
                            <option value=""> =Pilih= </option>
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                        <button type="submit" class="btn btn-info btn-lg mt-4" id="btn_add">
                            <i class="fas fa-plus"> Add</i>
                        </button>
                    </div>
                </div>

                <hr class="mt-2 mb-5">
                <h5 class="text-center mb-2">Buku yang dikembalikan sementara</h5>
                <div class="table-responsive">
                    <table class="table table-striped" id="table-ascending">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Buku</th>
                                <th>Nama Penerbit</th>
                                <th>Nama Pengarang</th>
                                <th>Banyak Buku Kembali</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_sementara">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <hr class="mt-2 mb-5">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-lg mt-4 btn-round" id="btn_simpan">
                        <i class="fas fa-exchange-alt"> Kembalikan</i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-12">
        <div class="card card-info">
            <div class="card-body">
                <h5 class="text-center mb-2">Buku yang sudah dikembalikan</h5>
                <div class="table-responsive">
                    <table class="table table-striped" id="table-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Buku</th>
                                <th>Nama Penerbit</th>
                                <th>Nama Pengarang</th>
                                <th style="width: 20%;">Banyak Buku Kembali</th>
                                <th class="text-center" style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ij = 1;
                            foreach ($dataset['dataset_buku'] as $i) :
                                $arr = array_values($i);
                            ?>
                                <tr>
                                    <td><?= $ij++; ?></td>
                                    <?php
                                    for ($j = 0; $j < count($arr); $j++) :
                                    ?>
                                        <td><?= $arr[$j]; ?></td>
                                    <?php
                                    endfor
                                    ?>
                                    <td class="text-center" style="width: 10%;">
                                        <a href="#" data-id="<?= $arr[0]; ?>" class="btn btn-danger swal-confirm" data-toggle="tooltip" data-original-title="Hapus Rak Buku">
                                            <form action="<?= route_to('delete_rakbuku', $arr[0]); ?>" method="POST" id="hapus<?= $arr[0]; ?>" class="">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE" />
                                            </form>
                                            <i class="fas fa-trash"> Hapus</i>
                                        </a>
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

<!-- Section CSS -->
<?= $this->section('page_css'); ?>
<link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/datatables/datatables.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/jquery-selectric/selectric.css">
<?= $this->endSection(); ?>


<!-- Section JS Page Modules -->
<?= $this->section('page_modules'); ?>
<script src="<?= base_url(); ?>/assets/modules/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<?= $this->endSection(); ?>


<!-- Section JS Page Before JS -->
<?= $this->section('page_beforejs'); ?>
<script src="<?= base_url(); ?>/assets/js/page/modules-datatables.js"></script>
<?= $this->endSection(); ?>


<!-- Section JS Page After JS -->
<?= $this->section('page_afterjs'); ?>
<script>
    const array_buku = <?php echo json_encode($dataset['data_buku']) ?>;
    const array_buku_temp = [];

    $(document).on('click', '.swal-confirm', function(e) {
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

    $('#data_buku').on('change', function() {
        let index_buku = $('#data_buku').prop('selectedIndex');
        if (index_buku == 0) {
            kosongkan();
            $('#banyak_buku').val('').change();
            $('#banyak_buku').prop('disabled', true);
        } else {
            var stringhmlt = '<option value=""> =Pilih= </option>';
            for (let i = 1; i <= array_buku[index_buku - 1].kurang_buku; i++) {
                stringhmlt += '<option value="' + i + '">' + i + '</option>';
            }
            $('#banyak_buku').html(stringhmlt);

            $('#nama_buku').val(array_buku[index_buku - 1].nama_buku);
            $('#nama_penerbit').val(array_buku[index_buku - 1].nama_penerbit);
            $('#nama_pengarang').val(array_buku[index_buku - 1].nama_pengarang);
            $('#banyak_buku').prop('disabled', false);
            $('#banyak_buku').focus();
        }
    });

    $('#btn_add').on('click', function() {
        let index_buku = $('#data_buku').prop('selectedIndex');
        let index_banyak_buku = $('#banyak_buku').prop('selectedIndex');
        if (index_buku == 0) {
            swal('Warning', 'Mohon pilih buku terlebih dahulu!', 'warning', {
                buttons: false,
                timer: 1000,
            });
        } else if (index_banyak_buku == 0) {
            swal('Warning', 'Mohon pilih banyak buku!', 'warning', {
                buttons: false,
                timer: 1000,
            });
        } else {
            let indexs = array_buku_temp.findIndex(arr => arr.includes($('#data_buku').val()));
            array_buku[index_buku - 1].kurang_buku = Number(array_buku[index_buku - 1].kurang_buku) - Number($('#banyak_buku').val());
            if (indexs != -1) {
                array_buku_temp[indexs][4] = Number(array_buku_temp[indexs][4]) + Number($('#banyak_buku').val());
            } else {
                array_buku_temp.push([
                    $('#data_buku').val(),
                    $('#nama_buku').val(),
                    $('#nama_penerbit').val(),
                    $('#nama_pengarang').val(),
                    $('#banyak_buku').val()
                ]);
            }

            reloadTable();
            kosongkan();
            $('#banyak_buku').val('').change();
            $('#data_buku').val('').change();
            $('#banyak_buku').prop('disabled', true);
        }
    });

    function reloadTable() {
        var stringhmlt = "";
        for (let i = 0; i < array_buku_temp.length; i++) {
            stringhmlt +=
                '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + array_buku_temp[i][1] + '</td>' +
                '<td>' + array_buku_temp[i][2] + '</td>' +
                '<td>' + array_buku_temp[i][3] + '</td>' +
                '<td>' + array_buku_temp[i][4] + '</td>' +
                '<td class="text-center">' +
                '<a href="#" class="btn btn-danger btn_hapus" data-index="' + i + '">' +
                '<i class="fas fa-times"></i> Batal' +
                '</a>' +
                '</td>' +
                '</tr>';
        }
        $('#tbody_sementara').html(stringhmlt);
    }

    $(document).on('click', '.btn_hapus', function(e) {
        var index = $(this).data('index');

        let indexs = array_buku.findIndex(function(element) {
            return element.id_buku === array_buku_temp[index][0];
        });

        array_buku[indexs].kurang_buku = Number(array_buku[indexs].kurang_buku) + Number(array_buku_temp[index][4]);

        array_buku_temp.splice(index, 1);

        reloadTable();
    });

    $('#btn_simpan').on('click', function() {
        if (array_buku_temp.length == 0) {
            swal('Warning', 'Table data buku masih kosong!', 'warning', {
                buttons: false,
                timer: 1000,
            });
        } else {
            $.ajax({
                type: "POST",
                url: "<?= route_to('update_pengembalian', $id_transaksi); ?>",
                cache: false,
                data: {
                    arr_buku: array_buku_temp
                },
                success: function(data) {
                    // alert(data);
                    swal('Informasi', 'Data buku berhasil dikembalikan!', 'success').then((data) => {
                        if (data) {
                            window.location.href = '<?php echo route_to("view_pengembalian", $id_transaksi)  ?>';
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        }
    });

    function kosongkan() {
        $('#nama_buku').val(null);
        $('#nama_penerbit').val(null);
        $('#nama_pengarang').val(null);
        $('#banyak_buku').val(null);
    }
</script>
<?= $this->endSection(); ?>