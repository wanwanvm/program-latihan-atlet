<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// CABOR
$routes->get('/cabang-olahraga', 'Cabor::index');
$routes->add('/cabang-olahraga/add', 'Cabor::add');
$routes->get('/cabang-olahraga/(:segment)/delete', 'Cabor::delete/$1');
$routes->add('/cabang-olahraga/(:segment)/edit', 'Cabor::edit/$1');

// PELATIH
$routes->get('/manage-pelatih', 'Pelatih::index');
$routes->get('/manage-pelatih/create', 'Pelatih::create');
$routes->get('/manage-pelatih/(:segment)/detail', 'Pelatih::detail/$1');
$routes->get('/manage-pelatih/(:segment)/edit', 'Pelatih::edit/$1');
$routes->add('/manage-pelatih/(:segment)/process_edit', 'Pelatih::process_edit/$1');
$routes->add('/manage-pelatih/add', 'Pelatih::add');
$routes->get('/manage-pelatih/(:segment)/delete', 'Pelatih::delete/$1');

// ATLET
$routes->get('/manage-atlet', 'Atlet::index');
$routes->get('/manage-atlet/create', 'Atlet::create');
$routes->get('/manage-atlet/(:segment)/detail', 'Atlet::detail/$1');
$routes->get('/manage-atlet/(:segment)/edit', 'Atlet::edit/$1');
$routes->add('/manage-atlet/(:segment)/process_edit', 'Atlet::process_edit/$1');
$routes->add('/manage-atlet/add', 'Atlet::add');
$routes->get('/manage-atlet/(:segment)/delete', 'Atlet::delete/$1');

// PROFIL
$routes->get('/profil', 'Profil::index');
$routes->add('/profil/(:segment)/process_edit', 'Profil::process_edit/$1');

// PROGRAM LATIHAN
$routes->get('/program-latihan', 'ProgramLatihan::index');
$routes->get('/program-latihan/create', 'ProgramLatihan::create');
$routes->add('/program-latihan/tanggal-program', 'ProgramLatihan::add_tanggal');
$routes->add('/program-latihan/add', 'ProgramLatihan::add');
$routes->get('/program-latihan/(:segment)/detail', 'ProgramLatihan::detail/$1');
$routes->get('/program-latihan/(:segment)/grafik', 'ProgramLatihan::grafik/$1');
$routes->get('/program-latihan/(:segment)/delete', 'ProgramLatihan::delete/$1');

// LOGIN
$routes->get('/login', 'Auth\Login::index');
$routes->post('/login/submit', 'Auth\Login::submit');
$routes->get('/logout', 'Auth\Login::logout');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
