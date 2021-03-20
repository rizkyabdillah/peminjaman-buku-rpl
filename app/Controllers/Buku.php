<?php

namespace App\Controllers;

class Buku extends BaseController
{

    private function array_default()
    {
        return array(
            'header_title' => 'Data Buku',
            'badges' => 'Daftar Data Buku',
            'sidebar' => 2,
            'desc_badges' => 'Berikut adalah daftar semua data buku yang terdaftar',
            'link_breadcrumb' => route_to('view_buku')
        );
    }

    public function index()
    {

        $query = $this->querys->query_buku_short();
        $dataset = $this->model->queryArray($query);
        // $dataset = $this->model->getAllDataArray('buku');

        $components = array(
            'is_show_badge3' => false,
            'link_add' => route_to('view_add_buku'),
            'dataset' => $dataset
        );

        // return dd($dataset);

        return view('admin/pages/layouts/Buku', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

}
