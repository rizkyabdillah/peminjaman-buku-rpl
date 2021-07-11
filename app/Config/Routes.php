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
$routes->get('bcrypt/(:any)', 'Auth::getBcrypt/$1', [
	'as' => 'get_bcrypt'
]);

$routes->get('/dashboard', '', ['filter' => 'is_not_login']);
$routes->get('/auth', '', ['filter' => 'is_not_login']);
$routes->get('/anggota', '', ['filter' => 'is_not_login']);
$routes->get('/buku', '', ['filter' => 'is_not_login']);
$routes->get('/kategori', '', ['filter' => 'is_not_login']);
$routes->get('/pegawai', '', ['filter' => 'is_not_login']);
$routes->get('/penerbit', '', ['filter' => 'is_not_login']);
$routes->get('/pengarang', '', ['filter' => 'is_not_login']);
$routes->get('/rakbuku', '', ['filter' => 'is_not_login']);

$routes->group('/', ['filter' => 'is_login'], function ($routes) {

	$routes->get('', 'Auth::index');

	$routes->get('login', 'Auth::index', [
		'as' => 'view_login'
	]);

	$routes->post('auth', 'Auth::auth', [
		'as' => 'auth_login'
	]);
});


$routes->group('admin', ['filter' => 'is_not_login'], function ($routes) {

	$routes->get('/', 'Dashboard::index', ['as' => 'view_dashboard']);
	$routes->get('logout', 'Auth::logout', ['as' => 'logout']);

	$routes->group('buku', function ($routes) {
		$routes->get('/', 'Buku::index', ['as' => 'view_buku']);
		$routes->get('add', 'Buku::add', ['as' => 'view_add_buku']);
		$routes->post('save', 'Buku::save', ['as' => 'save_buku']);
		$routes->delete('(:any)', 'Buku::delete/$1', ['as' => 'delete_buku']);
		$routes->get('(:any)', 'Buku::edit/$1', ['as' => 'view_edit_buku']);
		$routes->post('(:any)', 'Buku::update/$1', ['as' => 'update_buku']);
	});

	$routes->group('kategori', function ($routes) {
		$routes->get('/', 'Kategori::index', ['as' => 'view_kategori']);
		$routes->get('add', 'Kategori::add', ['as' => 'view_add_kategori']);
		$routes->post('save', 'Kategori::save', ['as' => 'save_kategori']);
		$routes->delete('(:any)', 'Kategori::delete/$1', ['as' => 'delete_kategori']);
		$routes->get('(:any)', 'Kategori::edit/$1', ['as' => 'view_edit_kategori']);
		$routes->post('(:any)', 'Kategori::update/$1', ['as' => 'update_kategori']);
	});

	$routes->group('rakbuku', function ($routes) {
		$routes->get('/', 'Rakbuku::index', ['as' => 'view_rakbuku']);
		$routes->get('add', 'Rakbuku::add', ['as' => 'view_add_rakbuku']);
		$routes->post('save', 'Rakbuku::save', ['as' => 'save_rakbuku']);
		$routes->delete('(:any)', 'Rakbuku::delete/$1', ['as' => 'delete_rakbuku']);
		$routes->get('(:any)', 'Rakbuku::edit/$1', ['as' => 'view_edit_rakbuku']);
		$routes->post('(:any)', 'Rakbuku::update/$1', ['as' => 'update_rakbuku']);
	});

	$routes->group('penerbit', function ($routes) {
		$routes->get('/', 'Penerbit::index', ['as' => 'view_penerbit']);
		$routes->get('add', 'Penerbit::add', ['as' => 'view_add_penerbit']);
		$routes->post('save', 'Penerbit::save', ['as' => 'save_penerbit']);
		$routes->delete('(:any)', 'Penerbit::delete/$1', ['as' => 'delete_penerbit']);
		$routes->get('(:any)', 'Penerbit::edit/$1', ['as' => 'view_edit_penerbit']);
		$routes->post('(:any)', 'Penerbit::update/$1', ['as' => 'update_penerbit']);
	});

	$routes->group('pengarang', function ($routes) {
		$routes->get('/', 'Pengarang::index', ['as' => 'view_pengarang']);
		$routes->get('add', 'Pengarang::add', ['as' => 'view_add_pengarang']);
		$routes->post('save', 'Pengarang::save', ['as' => 'save_pengarang']);
		$routes->delete('(:any)', 'Pengarang::delete/$1', ['as' => 'delete_pengarang']);
		$routes->get('(:any)', 'Pengarang::edit/$1', ['as' => 'view_edit_pengarang']);
		$routes->post('(:any)', 'Pengarang::update/$1', ['as' => 'update_pengarang']);
	});

	$routes->group('anggota', function ($routes) {
		$routes->get('/', 'Anggota::index', ['as' => 'view_anggota']);
		$routes->get('add', 'Anggota::add', ['as' => 'view_add_anggota']);
		$routes->post('save', 'Anggota::save', ['as' => 'save_anggota']);
		$routes->delete('(:any)', 'Anggota::delete/$1', ['as' => 'delete_anggota']);
		$routes->get('(:any)', 'Anggota::edit/$1', ['as' => 'view_edit_anggota']);
		$routes->post('(:any)', 'Anggota::update/$1', ['as' => 'update_anggota']);
	});

	$routes->group('pegawai', function ($routes) {
		$routes->get('/', 'Pegawai::index', ['as' => 'view_pegawai']);
		$routes->get('add', 'Pegawai::add', ['as' => 'view_add_pegawai']);
		$routes->post('save', 'Pegawai::save', ['as' => 'save_pegawai']);
		$routes->delete('(:any)', 'Pegawai::delete/$1', ['as' => 'delete_pegawai']);
		$routes->get('(:any)', 'Pegawai::edit/$1', ['as' => 'view_edit_pegawai']);
		$routes->post('c', 'Pegawai::update/$1', ['as' => 'update_pegawai']);
	});

	$routes->group('transaksi', function ($routes) {
		$routes->get('/', 'Transaksi::index', ['as' => 'view_transaksi']);
		$routes->get('add', 'Transaksi::add', ['as' => 'view_add_transaksi']);
		$routes->get('pengembalian/(:any)', 'Transaksi::pengembalian/$1', ['as' => 'view_pengembalian']);
		$routes->post('save', 'Transaksi::save', ['as' => 'save_transaksi']);
		$routes->post('detail', 'Transaksi::detail', ['as' => 'detail_transaksi']);
		$routes->post('(:any)', 'Transaksi::update/$1', ['as' => 'update_pengembalian']);
		$routes->delete('(:any)', 'Transaksi::delete/$1', ['as' => 'delete_transaksi']);
	});

	$routes->group('denda', function ($routes) {
		$routes->get('/', 'Denda::index', ['as' => 'view_denda']);
		$routes->delete('(:any)', 'Denda::delete/$1', ['as' => 'delete_denda']);
		$routes->post('data', 'Denda::datadenda', ['as' => 'datadenda']);
		$routes->post('/', 'Denda::update', ['as' => 'update_denda']);
	});
});

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
