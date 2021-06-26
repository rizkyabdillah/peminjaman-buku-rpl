<?= $this->extend('admin/partials/master') ?>

<?= $this->section('layouts-contents') ?>


<div class="row">


    <div class="col-12 col-md-6 col-lg-12">
        <div class="card card-info">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Pilih Anggota</label>
                        <?php
                        $data_anggota = array('' => '=== Pilih ===');
                        foreach ($dataset['data_anggota'] as $i) {
                            $data_anggota[$i['id_anggota']] = $i['nama_anggota'];
                        }
                        echo form_dropdown('data_anggota', $data_anggota, '', 'class="form-control select2 " id="data_anggota"');
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nama_buku">Nomor Transaksi</label>
                        <input type="text" class="form-control" name="nomor_rak" value="<?= $id_transaksi ?>" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nomor_rak">Tanggal Pinjam</label>
                        <input type="text" class="form-control" name="nomor_rak" value="<?= date("Y-m-d H:i:s") ?>" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nomor_rak">Tanggal Kembali</label>
                        <input type="text" class="form-control" name="nomor_rak" value="<?= date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s") . ' + 7 days')) ?>" readonly>
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
                        <input type="number" class="form-control" id="banyak_buku" value="" autofocus>
                    </div>
                    <div class="form-group col-md-1">
                        <button type="submit" class="btn btn-info btn-lg mt-4" id="btn_add">
                            <i class="fas fa-plus"> Add</i>
                        </button>
                    </div>
                </div>

                <hr class="mt-2 mb-5">

                <div class="table-responsive">
                    <table class="table table-bordered table-lg">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Buku</th>
                                <th>Nama Penerbit</th>
                                <th>Nama Pengarang</th>
                                <th>Banyak Buku</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <hr class="mt-2 mb-5">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="nama_buku">Total Buku</label>
                        <input type="text" class="form-control" id="total_buku" value="0 Buku" readonly>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-lg mt-4 btn-round" id="btn_simpan">
                        <i class="fas fa-save"> Simpan</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?= $this->endSection(); ?>

<!-- Section CSS -->
<?= $this->section('page_css'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/assets/modules/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/assets/modules/jquery-selectric/selectric.css">
<?= $this->endSection(); ?>


<!-- Section JS Page Modules -->
<?= $this->section('page_modules'); ?>
<script src="<?= base_url() ?>/assets/modules/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url() ?>/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<?= $this->endSection(); ?>


<!-- Section JS Page Before JS -->
<?= $this->section('page_beforejs'); ?>

<?= $this->endSection(); ?>


<!-- Section JS Page After JS -->
<?= $this->section('page_afterjs'); ?>
<script>
    const array_buku = [];

    $('#data_anggota').change(function() {
        var index_anggota = $('#data_anggota').prop('selectedIndex');
    });

    $('#data_buku').change(function() {
        var index_buku = $('#data_buku').prop('selectedIndex');
        var arrays = <?php echo json_encode($dataset['data_buku']) ?>

        if (index_buku == 0) {
            kosongkan();
        } else {
            $('#nama_buku').val(arrays[index_buku - 1].nama_buku);
            $('#nama_penerbit').val(arrays[index_buku - 1].nama_penerbit);
            $('#nama_pengarang').val(arrays[index_buku - 1].nama_pengarang);
            $('#banyak_buku').focus();
        }
    });

    function kosongkan() {
        $('#nama_buku').val(null);
        $('#nama_penerbit').val(null);
        $('#nama_pengarang').val(null);
        $('#banyak_buku').val(null);
    }

    $('#btn_add').click(function() {
        var index_buku = $('#data_buku').prop('selectedIndex');
        if (index_buku == 0 || index_buku == null) {
            swal('Warning', 'Mohon pilih buku terlebih dahulu!', 'warning', {
                buttons: false,
                timer: 1000,
            });
        } else if ($('#banyak_buku').val() == "") {
            swal('Warning', 'Mohon isikan banyak buku!', 'warning', {
                buttons: false,
                timer: 1000,
            });
            $('#banyak_buku').focus();
        } else {

            let indexs = array_buku.findIndex(arr => arr.includes($('#data_buku').val()));

            if (indexs != -1) {
                array_buku[indexs][4] = Number(array_buku[indexs][4]) + Number($('#banyak_buku').val());
            } else {
                array_buku.push([
                    $('#data_buku').val(),
                    $('#nama_buku').val(),
                    $('#nama_penerbit').val(),
                    $('#nama_pengarang').val(),
                    $('#banyak_buku').val()
                ]);
            }

            $('#total_buku').val(getTotal() + " Buku");
            $('#data_buku').val("").change();
            reloadTable();
            kosongkan();
        }
    });

    function reloadTable() {
        var stringhmlt = "";
        for (let i = 0; i < array_buku.length; i++) {
            stringhmlt +=
                '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + array_buku[i][1] + '</td>' +
                '<td>' + array_buku[i][2] + '</td>' +
                '<td>' + array_buku[i][3] + '</td>' +
                '<td>' + array_buku[i][4] + '</td>' +
                '<td class="text-center">' +
                '<a href="#" class="btn btn-danger btn_hapus" data-index="' + i + '">' +
                '<i class="fas fa-trash"></i> Hapus' +
                '</a>' +
                '</td>' +
                '</tr>';
        }
        $('tbody').html(stringhmlt);
    }


    $(document).on('click', '.btn_hapus', function(e) {
        var index = $(this).data('index');
        array_buku.splice(index, 1);
        $('#total_buku').val(getTotal() + " Buku");
        reloadTable();
    });

    function getTotal() {
        let total = 0;
        for (let i = 0; i < array_buku.length; i++) {
            total += Number(array_buku[i][4]);
        }
        return total;
    }

    $('#btn_simpan').click(function() {
        if ($('#data_anggota').prop('selectedIndex') == 0) {
            swal('Warning', 'Mohon pilih nama anggota!', 'warning', {
                buttons: false,
                timer: 1000,
            });
        } else if (getTotal() == 0) {
            swal('Warning', 'Buku yang dipinjam masih kosong!', 'warning', {
                buttons: false,
                timer: 1000,
            });
        }
    });
</script>
<?= $this->endSection(); ?>