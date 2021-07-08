<?php

namespace App\Controllers;

class Transaksi extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------------------------------------------------

    private function array_default()
    {
        return array(
            'header_title' => 'Data Transaksi',
            'badges' => 'Pages Data Transaksi',
            'sidebar' => 9,
            'link_breadcrumb' => route_to('view_transaksi')
        );
    }

    //--------------------------------------------------------------------

    public function index()
    {

        $query = $this->query->query_transaksi();
        $dataset = $this->model->queryArray($query);
        $components = array(
            'is_show_badge3' => false,
            'link_add' => route_to('view_add_transaksi'),
            'desc_badges' => 'Berikut adalah daftar semua data transaksi yang terdaftar',
            'dataset' => $dataset
        );

        return view('admin/pages/layouts/transaksi', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function add()
    {

        $data_anggota = $this->model->getAllDataArray("ANGGOTA");
        $query = $this->query->query_buku_short();
        $data_buku = $this->model->queryArray($query);

        $id_transaksi = $this->utility->get_random(12);

        $dataset = [
            'data_anggota' => $data_anggota,
            'data_buku' => $data_buku,
        ];

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Tambah Transaksi Peminjaman',
            'link_back' => route_to('view_transaksi'),
            'desc_badges' => 'Tambahkan data peminjaman buku pada form dibawah ini',
            'text_header_form' => 'Tambah Peminjaman Buku',
            'dataset' => $dataset,
            'id_transaksi' => $id_transaksi,
            'valid' => $this->validation
        );

        return view('admin/pages/adds/add-transaksi', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function save()
    {

        $data = array(
            'id_transaksi' => $this->request->getPost('id_transaksi'),
            'tanggal_peminjaman' => $this->request->getPost('tanggal_pinjam'),
            'tanggal_harus_kembali' => $this->request->getPost('tanggal_kembali'),
            'status' => 'PROGRESS',
            'id_anggota' => $this->request->getPost('id_anggota'),
            'id_pegawai' => session()->get('id_user'),
            'id_denda' => null
        );
        $this->model->insertData('TRANSAKSI', $data);

        $arr_buku = $this->request->getPost('arr_buku');

        foreach ($arr_buku as $value) {
            $data = array(
                'id_transaksi' => $this->request->getPost('id_transaksi'),
                'id_buku' => $value[0],
                'banyak_buku' => $value[4]
            );
            $this->model->insertData('DETAIL_PEMINJAMAN', $data);

            $data = array(
                'id_transaksi' => $this->request->getPost('id_transaksi'),
                'id_buku' => $value[0],
                'banyak_buku_kembali' => 0
            );
            $this->model->insertData('DETAIL_PENGEMBALIAN', $data);
        }
        echo json_encode(['status' => 'sukses']);
    }

    //--------------------------------------------------------------------

    public function delete($id)
    {
        $transaksi = $this->model->getDataWhereArray('TRANSAKSI', ['id_transaksi' => $id]);
        if ($transaksi) {
            $this->model->deleteData('DENDA', ['id_denda' => $transaksi[0]['id_denda']]);
        }
        $this->model->deleteData('DETAIL_PENGEMBALIAN', ['id_transaksi' => $id]);
        $this->model->deleteData('DETAIL_PEMINJAMAN', ['id_transaksi' => $id]);
        $this->model->deleteData('TRANSAKSI', ['id_transaksi' => $id]);
        session()->setFlashData('pesan', 'Data transaksi berhasil dihapus');
        return redirect()->to(route_to('view_transaksi'));
    }

    //--------------------------------------------------------------------

    public function detail()
    {
        $id = $this->request->getVar('id_transaksi');
        $query = $this->query->query_detail_peminjaman($id);
        $peminjaman = $this->model->queryArray($query);
        echo json_encode($peminjaman);
    }

    //--------------------------------------------------------------------

    public function pengembalian($id)
    {
        $data_transaksi = $this->model->getRowDataArray('TRANSAKSI', ['id_transaksi' => $id]);
        $data_anggota = $this->model->getRowDataArray('ANGGOTA', ['id_anggota' => $data_transaksi['id_anggota']]);
        $data_buku_belum_kembali = $this->model->queryArray($this->query->query_buku_belum_kembali($id));
        $data_buku_sudah_kembali = $this->model->queryArray($this->query->query_buku_sudah_kembali($id));

        $dataset = [
            'data_transaksi' => $data_transaksi,
            'data_anggota' => $data_anggota,
            'data_buku' => $data_buku_belum_kembali,
            'dataset_buku' => $data_buku_sudah_kembali,
        ];

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Kelola Pengembalian',
            'link_back' => route_to('view_transaksi'),
            'desc_badges' => 'Tambahkan data pengembalian buku pada form dibawah ini',
            'text_header_form' => 'Tambah Pengembalian Buku',
            'dataset' => $dataset,
            'id_transaksi' => $id,
            'valid' => $this->validation
        );

        return view('admin/pages/adds/add-pengembalian', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------


    public function update($id)
    {
        $transaksi = $this->model->getRowDataArray('TRANSAKSI', ['id_transaksi' => $id]);

        $tanggal_kembali = date_create($transaksi['tanggal_harus_kembali']);
        $tanggal_sekarang = date_create(date("Y-m-d H:i:s"));

        $terlambat = date_diff($tanggal_kembali, $tanggal_sekarang);
        $hari = $terlambat->format("%R%a");

        $arr_buku = $this->request->getPost('arr_buku');

        foreach ($arr_buku as $value) {
            $count_buku = $this->model->getDataColumnWhereArray(
                'DETAIL_PENGEMBALIAN',
                'banyak_buku_kembali',
                [
                    'id_transaksi' => $id,
                    'id_buku' => $value[0],
                ]
            );
            $this->model->updateDataFilter(
                'DETAIL_PENGEMBALIAN',
                [
                    'id_transaksi' => $id,
                    'id_buku' => $value[0],
                ],
                [
                    'banyak_buku_kembali' => ($count_buku[0]['banyak_buku_kembali'] + $value[4])
                ]
            );
        }

        if (($hari + 1) > 0) {

            $banyak_buku = 0;
            foreach ($arr_buku as $value) {
                $banyak_buku += $value[4];
            }

            if ($transaksi['id_denda'] == null) {
                $id_denda = $this->utility->get_random(5);
                $this->model->updateData('TRANSAKSI', 'id_transaksi', $id, ['id_denda' => $id_denda]);

                $data = [
                    'id_denda' => $id_denda,
                    'status_bayar' => 'BELUM LUNAS',
                    'banyak_buku' => $banyak_buku,
                    'total_denda' => ($banyak_buku * ($hari + 1) * 1000),
                    'total_bayar' => 0
                ];
                $this->model->insertData('DENDA', $data);
            } else {
                $denda = $this->model->getRowDataArray('DENDA', ['id_denda' => $transaksi['id_denda']]);
                $total_denda = ($banyak_buku * ($hari + 1) * 1000) + $denda['total_denda'];
                $total_buku = $denda['banyak_buku'] + $banyak_buku;

                $this->model->updateData('DENDA', 'id_denda', $transaksi['id_denda'], [
                    'banyak_buku' => $total_buku,
                    'total_denda' => $total_denda
                ]);
            }

            $data_buku_belum_kembali = $this->model->queryArray($this->query->query_buku_belum_kembali($id));
            if (!$data_buku_belum_kembali) {
                $this->model->updateData('TRANSAKSI', 'id_transaksi', $id, [
                    'status' => 'DENDA'
                ]);
            }
        }


        echo json_encode(['status' => 'sukses']);
    }


    //--------------------------------------------------------------------





}
