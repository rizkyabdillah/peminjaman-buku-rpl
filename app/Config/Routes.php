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
});

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
