<?php

namespace App\Controllers;

class Dashboard extends BaseController
{


    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------------------------------------------------

    private function array_default()
    {
        return array(
            'header_title' => 'Halaman Dashboard',
            'badges' => 'Halaman Dashboard',
            'sidebar' => 1,
            'link_breadcrumb' => route_to('view_dashboard')
        );
    }

    //--------------------------------------------------------------------

    public function index()
    {

        $count_buku = $this->model->getSelectCount('BUKU', 'id_buku', 'count');
        $count_anggota = $this->model->getSelectCount('ANGGOTA', 'id_anggota', 'count');
        $count_peminjaman = $this->model->getSelectCount('TRANSAKSI', 'id_transaksi', 'count', ['status' => 'PROGRESS']);
        $count_denda = $this->model->getSelectCount('DENDA', 'id_denda', 'count');

        $transaksi = $this->model->queryArray($this->query->query_transaksi_dashboard());

        $components = array(
            'is_show_badge3' => false,
            'desc_badges' => 'Halaman ringkas dan view grafik dari master data',
            'count_buku' => $count_buku['count'],
            'count_anggota' => $count_anggota['count'],
            'count_peminjaman' => $count_peminjaman['count'],
            'count_denda' => $count_denda['count'],
            'transaksi' => $transaksi
        );
        // return dd($transaksi);
        return view('admin/pages/layouts/dashboard', array_merge($this->array_default(), $components));
    }
}
