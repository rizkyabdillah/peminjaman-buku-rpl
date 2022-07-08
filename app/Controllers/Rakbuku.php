<?php

namespace App\Controllers;

class RakBuku extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------------------------------------------------

    private function array_default()
    {
        return array(
            'header_title' => 'Data Rak Buku',
            'badges' => 'Pages Data Rak Buku',
            'sidebar' => 4,
            'link_breadcrumb' => route_to('view_rak')
        );
    }

    //--------------------------------------------------------------------

    public function index()
    {

        $query = $this->query->query_rak_show_all();
        $dataset = $this->model->queryArray($query);
        $components = array(
            'is_show_badge3' => false,
            'link_add' => route_to('view_add_rak'),
            'desc_badges' => 'Berikut adalah daftar semua data rak yang terdaftar',
            'dataset' => $dataset,
        );

        return view('admin/pages/layouts/rak', array_merge($this->array_default(), $components));
    }
}
