<?php

namespace Config;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// $routes->get('/', 'Home::index');

$routes->group('admin', function ($routes) {

	$routes->group(
		'buku',
		/**['filter' => 'login_admin'],**/
		function ($routes) {
			$routes->get('/', 'Buku::index', ['as' => 'view_buku']);
			$routes->get('add', 'Buku::add', ['as' => 'view_add_buku']);
			$routes->post('save', 'Buku::save', ['as' => 'save_buku']);
			$routes->delete('(:any)', 'Buku::delete/$1', ['as' => 'delete_buku']);
			$routes->get('(:any)', 'Buku::edit/$1', ['as' => 'view_edit_buku']);
			$routes->post('(:any)', 'Buku::update/$1', ['as' => 'update_buku']);
		}
	);

	$routes->group(
		'kategori',
		/**['filter' => 'login_admin'],**/
		function ($routes) {
			$routes->get('/', 'Kategori::index', ['as' => 'view_kategori']);
			$routes->get('add', 'Kategori::add', ['as' => 'view_add_kategori']);
			$routes->post('save', 'Kategori::save', ['as' => 'save_kategori']);
			$routes->delete('(:any)', 'Kategori::delete/$1', ['as' => 'delete_kategori']);
			$routes->get('(:any)', 'Kategori::edit/$1', ['as' => 'view_edit_kategori']);
			$routes->post('(:any)', 'Kategori::update/$1', ['as' => 'update_kategori']);
		}
	);

	$routes->group(
		'rak',
		/**['filter' => 'login_admin'],**/
		function ($routes) {
			$routes->get('/', 'RakBuku::index', ['as' => 'view_rak']);
			$routes->get('add', 'RakBuku::add', ['as' => 'view_add_rak']);
			$routes->post('save', 'RakBuku::save', ['as' => 'save_kategori']);
			$routes->delete('(:any)', 'RakBuku::delete/$1', ['as' => 'delete_rak']);
			$routes->get('(:any)', 'RakBuku::edit/$1', ['as' => 'view_edit_rak']);
			$routes->post('(:any)', 'RakBuku::update/$1', ['as' => 'update_rak']);
		}
	);

	$routes->group(
		'penerbit',
		/**['filter' => 'login_admin'],**/
		function ($routes) {
			$routes->get('/', 'Penerbit::index', ['as' => 'view_penerbit']);
			$routes->get('add', 'Penerbit::add', ['as' => 'view_add_penerbit']);
			$routes->post('save', 'Penerbit::save', ['as' => 'save_penerbit']);
			$routes->delete('(:any)', 'Penerbit::delete/$1', ['as' => 'delete_penerbit']);
			$routes->get('(:any)', 'Penerbit::edit/$1', ['as' => 'view_edit_penerbit']);
			$routes->post('(:any)', 'Penerbit::update/$1', ['as' => 'update_penerbit']);
		}
	);

	$routes->group(
		'pengarang',
		/**['filter' => 'login_admin'],**/
		function ($routes) {
			$routes->get('/', 'Pengarang::index', ['as' => 'view_pengarang']);
			$routes->get('add', 'Pengarang::add', ['as' => 'view_add_pengarang']);
			$routes->post('save', 'Pengarang::save', ['as' => 'save_pengarang']);
			$routes->delete('(:any)', 'Pengarang::delete/$1', ['as' => 'delete_pengarang']);
			$routes->get('(:any)', 'Pengarang::edit/$1', ['as' => 'view_edit_pengarang']);
			$routes->post('(:any)', 'Pengarang::update/$1', ['as' => 'update_pengarang']);
		}
	);

	$routes->group(
		'anggota',
		/**['filter' => 'login_admin'],**/
		function ($routes) {
			$routes->get('/', 'Anggota::index', ['as' => 'view_anggota']);
			$routes->get('add', 'Anggota::add', ['as' => 'view_add_anggota']);
			$routes->post('save', 'Anggota::save', ['as' => 'save_anggota']);
			$routes->delete('(:any)', 'Anggota::delete/$1', ['as' => 'delete_anggota']);
			$routes->get('(:any)', 'Anggota::edit/$1', ['as' => 'view_edit_anggota']);
			$routes->post('(:any)', 'Anggota::update/$1', ['as' => 'update_anggota']);
		}
	);

	$routes->group(
		'pegawai',
		/**['filter' => 'login_admin'],**/
		function ($routes) {
			$routes->get('/', 'Pegawai::index', ['as' => 'view_pegawai']);
			$routes->get('add', 'Pegawai::add', ['as' => 'view_add_pegawai']);
			$routes->post('save', 'Pegawai::save', ['as' => 'save_pegawai']);
			$routes->delete('(:any)', 'Pegawai::delete/$1', ['as' => 'delete_pegawai']);
			$routes->get('(:any)', 'Pegawai::edit/$1', ['as' => 'view_edit_pegawai']);
			$routes->post('(:any)', 'Pegawai::update/$1', ['as' => 'update_pegawai']);
		}
	);
});

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
