<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$components = array(
			'title' => 'Ini adalah judul test',
			'header_title' => 'Test Judul Header',
			'badges' => 'Daftar Data Buku',
			'desc_badges' => 'Berikut adalah daftar semua data buku yang terdaftar',

		);
		return view('admin/pages/layouts/test', $components);
	}

	//--------------------------------------------------------------------

}
