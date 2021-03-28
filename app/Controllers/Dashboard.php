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

        $query = $this->query->query_buku_short();
        $components = array(
            'is_show_badge3' => false,
            'desc_badges' => 'Halaman ringkas dan view grafik dari master data',
        );

        return view('admin/pages/layouts/dashboard', array_merge($this->array_default(), $components));
    }
}
