<?= $this->extend('admin/partials/index-table') ?>

<?= $this->section('table-contents') ?>
<table class="table table-striped" id="table-descending">
    <thead>
        <tr>
            <th>Nama Buku</th>
            <th>Kategori</th>
            <th>Penerbit</th>
            <th>Pengarang</th>
            <th class="text-center" style="width: 8;">Jumlah Hlm</th>
            <th class="text-center">Gambar</th>
            <th class="text-center" style="width: 12;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataset as $i) :
            $arr = array_values($i);
        ?>
            <tr>
                <?php for ($j = 1; $j < count($arr) - 1; $j++) : ?>
                    <td><?= $arr[$j]; ?></td>
                <?php endfor ?>
                <td><img src="<?= base_url(); ?>/<?= $arr[count($arr) - 1]; ?>" width="70" height="90"></td>
                <td class="text-center">
                    <a href="<?= route_to('view_edit_buku', $arr[0]); ?>" class="btn btn-warning btn-action" data-toggle="tooltip" data-original-title="Ubah">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a data-id="<?= $arr[0]; ?>" class="btn btn-danger btn-action mr-1 ml-1 swal_confirm" data-toggle="tooltip" data-original-title="Hapus">
                        <form action="<?= route_to('delete_buku', $arr[0]); ?>" method="POST" id="hapus<?= $arr[0]; ?>" class="">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE" />
                        </form>
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
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
    $(document).on("click", ".swal_confirm", function(e) {
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