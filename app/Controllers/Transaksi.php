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
            'id_pegawai' => session()->get('id_user')
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
                'banyak_buku_kembali' => 0,
                'id_denda' => null,
            );
            $this->model->insertData('DETAIL_PENGEMBALIAN', $data);
        }
        echo json_encode(['status' => 'sukses']);
    }

    //--------------------------------------------------------------------

    public function delete($id)
    {
        $pengembalian = $this->model->getDataWhereArray('DETAIL_PENGEMBALIAN', ['id_transaksi' => $id]);
        for ($i = 0; $i < count($pengembalian); $i++) {
            $this->model->deleteData('DENDA', ['id_denda' => $pengembalian[$i]['id_denda']]);
        }
        $this->model->deleteData('DETAIL_PENGEMBALIAN', ['id_transaksi' => $id]);
        $this->model->deleteData('DETAIL_PEMINJAMAN', ['id_transaksi' => $id]);
        $this->model->deleteData('TRANSAKSI', ['id_transaksi' => $id]);
        // return dd($pengembalian);
        // $this->model->deleteData('rak_buku', array('id_rak' => $id));
        session()->setFlashData('pesan', 'Data transaksi berhasil dihapus');
        return redirect()->to(route_to('view_transaksi'));
    }

    //--------------------------------------------------------------------

    public function edit($id)
    {

        $query = $this->query->query_rakbuku_show_where($id);
        $dataset = $this->model->queryRowArray($query);

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Ubah Rak Buku',
            'link_back' => route_to('view_rakbuku'),
            'desc_badges' => 'Ubah data rak buku pada form dibawah ini',
            'text_header_form' => 'Ubah Rak Buku',
            'valid' => $this->validation,
            'dataset' => $dataset,
        );

        return view('admin/pages/edits/edit-rakbuku', array_merge($this->array_default(), $components));
    }

    // //--------------------------------------------------------------------


    public function update($id)
    {
        if (!$this->validate([
            'nomor_rak' => [
                'label' => 'Nomor Rak',
                'rules' => 'required|numeric|is_unique[rak_buku.nomor_rak, id_rak, ' . $id . ']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                    'is_unique' => '{field} sudah tersedia, harap ganti',
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        };

        /* ======= Saving data ======= */

        // Save field column value to array
        $data = array(
            'nomor_rak' => $this->request->getPost('nomor_rak'),
        );

        // Update data to rak_buku table
        $this->model->updateData('rak_buku', 'id_rak', $id, $data);

        /* ======= Show message and redirect back to index rak_buku ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data rak buku berhasil diubah');
        // Redirected back to index rak_buku
        return redirect()->to(route_to('view_rakbuku'));
    }


    //--------------------------------------------------------------------





}
