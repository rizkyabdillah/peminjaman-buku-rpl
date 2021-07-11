<?php

namespace App\Controllers;

class Denda extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------------------------------------------------

    private function array_default()
    {
        return array(
            'header_title' => 'Data Denda',
            'badges' => 'Pages Data Denda',
            'sidebar' => 10,
            'link_breadcrumb' => route_to('view_denda')
        );
    }

    //--------------------------------------------------------------------

    public function index()
    {
        $query = $this->query->query_denda();
        $dataset = $this->model->queryArray($query);
        $components = array(
            'is_show_badge3' => false,
            'desc_badges' => 'Berikut adalah daftar semua data denda yang terdaftar',
            'dataset' => $dataset,
        );

        return view('admin/pages/layouts/denda', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function delete($id)
    {
        $data_transaksi = $this->model->getDataWhereArray('TRANSAKSI', ['id_denda' => $id]);

        $this->model->updateData('TRANSAKSI', 'id_transaksi', $data_transaksi[0]['id_transaksi'], [
            'status' => 'PROGRESS',
            'id_denda' => null
        ]);
        $this->model->updateData('DETAIL_PENGEMBALIAN', 'id_transaksi', $data_transaksi[0]['id_transaksi'], ['banyak_buku_kembali' => 0]);
        $this->model->deleteData('DENDA', array('id_denda' => $id));

        session()->setFlashData('pesan', 'Data denda berhasil dihapus');
        return redirect()->to(route_to('view_denda'));
    }

    //--------------------------------------------------------------------

    public function datadenda()
    {
        $id = $this->request->getPost('id_denda');
        $data_denda = $this->model->getDataWhereArray('DENDA', ['id_denda' => $id]);
        echo json_encode($data_denda[0]);
    }

    //--------------------------------------------------------------------

    public function update()
    {
        $id_denda = $this->request->getPost('id_denda');
        $total_bayar = $this->request->getPost('total_bayar');
        $total_denda = $this->request->getPost('total_denda');

        $status_bayar = ($total_bayar >= $total_denda) ? 'LUNAS' : 'BELUM LUNAS';
        $status = ($total_bayar >= $total_denda) ? 'SELESAI' : 'DENDA';

        $this->model->updateData('DENDA', 'id_denda', $id_denda, [
            'total_bayar' => $total_bayar,
            'status_bayar' => $status_bayar
        ]);

        $this->model->updateData('TRANSAKSI', 'id_denda', $id_denda, [
            'status' => $status
        ]);

        session()->setFlashData('pesan', 'Data pembayaan denda berhasil diubah');
        return redirect()->to(route_to('view_denda'));
    }
}
