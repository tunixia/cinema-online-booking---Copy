<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('layout', 'Home::testLayout');
$routes->get('layout1', 'Home::testLayout1');
$routes->get('tl', 'Home::tl');
$routes->get('tl1', 'Home::tl1');
$routes->get('/admin','Admin::index');
$routes->get('/theater/location','Theater::location');
$routes->get('/test','Home::test');
$routes->get('/test1','Home::test1');
$routes->get('/timetest','Home::timeTest');
// $routes->get('/admin/register/theater','Theater::fillUp');


$routes->group('admin', function ($routes) {

    $routes->add('register/theater', 'Theater::fillUp');
    $routes->add('register/admin','Admin::register');
    $routes->add('login','Admin::login');
    $routes->add('logout','Admin::logout');
    $routes->add('dashboard','Admin::dashboard');

    $routes->add('movies','Movie::index');
    $routes->add('movie/add','Movie::add');
    $routes->add('movie/edit','Movie::edit');
    $routes->add('movie/delete','Movie::delete');
    $routes->add('movies/getAll','Movie::getAll');

    $routes->add('cinemas','Cinema::index');
    $routes->add('cinema/add','Cinema::add');
    $routes->add('cinema/edit','Cinema::edit');
    $routes->add('cinema/delete','Cinema::delete');
    $routes->add('cinemas/getAll','Cinema::getAll');


    $routes->add('shows','Show::index');

    // $routes->add('test','Admin::test');
    $routes->add('errorlogin','Admin::errorLogin');
    $routes->add('paginate','Admin::paginate');
});








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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
