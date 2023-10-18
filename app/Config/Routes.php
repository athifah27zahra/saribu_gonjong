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
$routes->get('/', 'LandingPage::index');
$routes->get('/403', 'Home::error403');
$routes->get('/login', 'Web\Profile::login');
$routes->get('/register', 'Web\Profile::register');

// Upload files
$routes->group('upload', ['namespace' => 'App\Controllers\Web'], function ($routes) {
    $routes->post('photo', 'Upload::photo');
    $routes->post('video', 'Upload::video');
    $routes->post('avatar', 'Upload::avatar');
    $routes->delete('avatar', 'Upload::remove');
    $routes->delete('photo', 'Upload::remove');
    $routes->delete('video', 'Upload::remove');
});

// Dashboard
$routes->group('dashboard', ['namespace' => 'App\Controllers\Web', 'filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('rumahGadang', 'Dashboard::rumahGadang',  ['filter' => 'role:admin']);
    $routes->get('tourismPackage', 'Dashboard::tourismPackage',  ['filter' => 'role:admin']);
    $routes->get('facilityRumahGadang', 'Dashboard::facilityRumahGadang', ['filter' => 'role:admin']);
    $routes->get('recommendation', 'Dashboard::recommendation',  ['filter' => 'role:admin']);
    $routes->get('worshipPlace', 'Dashboard::worshipPlace', ['filter' => 'role:admin']);
    $routes->get('umkmPlace', 'Dashboard::umkmPlace', ['filter' => 'role:admin']);
    $routes->get('souvenirPlace', 'Dashboard::souvenirPlace', ['filter' => 'role:admin']);
    $routes->get('historyPlace', 'Dashboard::historyPlace', ['filter' => 'role:admin']);
    $routes->get('users', 'Dashboard::users', ['filter' => 'role:admin']);
    $routes->get('tourismObject', 'Dashboard::tourismObject', ['filter' => 'role:admin']);
    $routes->get('packageActivities', 'Dashboard::packageActivities', ['filter' => 'role:admin']);
    $routes->get('study', 'Dashboard::study', ['filter' => 'role:admin']);
    $routes->get('myBooking', 'Dashboard::myBooking', ['filter' => 'role:admin']);
    $routes->get('facilityTourismPackage', 'Dashboard::facilityTourismPackage', ['filter' => 'role:admin']);
    $routes->addPlaceholder('tanggal', '[0-9]{4}-[0-9]{2}-[0-9]{2}');
    $routes->get('bookingDetail/(:alphanum)/(:tanggal)/(:num)', 'Dashboard::bookingDetail/$1/$2/$3', ['filter' => 'role:admin']);
    $routes->post('bookingDetail/(:alphanum)/(:tanggal)/(:num)', 'Dashboard::bookingDetail/$1/$2/$3', ['filter' => 'role:admin']);
    $routes->get('bookingDelete/(:alphanum)/(:tanggal)/(:num)', 'Dashboard::bookingDelete/$1/$2/$3', ['filter' => 'role:admin']);
    $routes->post('bookingDelete/(:alphanum)/(:tanggal)/(:num)', 'Dashboard::bookingDelete/$1/$2/$3', ['filter' => 'role:admin']);
    $routes->post('bookingPackage/(:alphanum)', 'Dashboard::bookingPackage/$1', ['filter' => 'role:admin']);
    $routes->post('bookingUpdate/(:alphanum)/(:tanggal)/(:num)', 'Dashboard::bookingUpdate/$1/$2/$3', ['filter' => 'role:admin']);
    
    $routes->presenter('rumahGadang',  ['filter' => 'role:admin']);
    $routes->presenter('tourismPackage',  ['filter' => 'role:admin']);
    $routes->presenter('facilityRumahGadang', ['filter' => 'role:admin']);
    $routes->presenter('facilityTourismPackage', ['filter' => 'role:admin']);
    $routes->presenter('users', ['filter' => 'role:admin']);
    $routes->presenter('myBooking', ['filter' => 'role:admin']);
    $routes->presenter('worshipPlace', ['filter' => 'role:admin']);
    $routes->presenter('umkmPlace', ['filter' => 'role:admin']);
    $routes->presenter('souvenirPlace', ['filter' => 'role:admin']);
    $routes->presenter('historyPlace', ['filter' => 'role:admin']);
    $routes->presenter('tourismObject', ['filter' => 'role:admin']);
    $routes->presenter('packageActivities', ['filter' => 'role:admin']);
    $routes->presenter('study', ['filter' => 'role:admin']);
});

$routes->group('web', ['namespace' => 'App\Controllers\Web'], function ($routes) {
    $routes->presenter('rumahGadang');
    $routes->presenter('tourismPackage');
    $routes->post('rumahGadang/(:alphanum)', 'RumahGadang::show/$1', ['filter' => 'role:user']);
    $routes->get('/', 'RumahGadang::recommendation');
    $routes->get('visitHistory', 'VisitHistory::visitHistory', ['filter' => 'role:user']);
    $routes->get('visitHistory/add', 'VisitHistory::addVisitHistory', ['filter' => 'role:user']);
    $routes->post('visitHistory', 'VisitHistory::visitHistory', ['filter' => 'role:user']);
    $routes->post('review', 'Review::add', [['filter' => 'role:user']]);
    

    $routes->group('profile', function ($routes) {
        $routes->get('/', 'Profile::profile', ['filter' => 'login']);
        $routes->get('changePassword', 'Profile::changePassword', ['filter' => 'login']);
        $routes->post('changePassword', 'Profile::changePassword', ['filter' => 'login']);
        $routes->get('update', 'Profile::updateProfile', ['filter' => 'login']);
        $routes->post('update', 'Profile::update', ['filter' => 'login']);
    });
});

$routes->group('booking', ['namespace' => 'App\Controllers\Web'], function ($routes) {
    $routes->get('keranjang/(:alphanum)', 'MyBooking::keranjang/$1', ['filter' => 'role:user']);
    $routes->post('keranjang/(:alphanum)', 'MyBooking::keranjang/$1', ['filter' => 'role:user']);
    $routes->post('checkout', 'MyBooking::checkout', ['filter' => 'role:user']);
    $routes->get('my', 'MyBooking::list', ['filter' => 'role:user']);
    $routes->addPlaceholder('tanggal', '[0-9]{4}-[0-9]{2}-[0-9]{2}');
    $routes->get('detail/(:alphanum)/(:tanggal)', 'MyBooking::detail/$1/$2', ['filter' => 'role:user']);
    $routes->post('detail/(:alphanum)/(:tanggal)', 'MyBooking::detail/$1/$2', ['filter' => 'role:user']);
    $routes->get('edit/(:alphanum)/(:tanggal)', 'MyBooking::editData/$1/$2', ['filter' => 'role:user']);
    $routes->post('edit/(:alphanum)/(:tanggal)', 'MyBooking::editData/$1/$2', ['filter' => 'role:user']);
    $routes->get('delete/(:alphanum)/(:tanggal)', 'MyBooking::bookdel/$1/$2', ['filter' => 'role:user']);
    $routes->post('delete/(:alphanum)/(:tanggal)', 'MyBooking::bookdel/$1/$2', ['filter' => 'role:user']);
    $routes->get('invoice/(:alphanum)/(:tanggal)', 'MyBooking::invoice/$1/$2', ['filter' => 'role:user']);
    $routes->get('ubahpaket/(:alphanum)', 'MyBooking::custom/$1', ['filter' => 'role:user']);

});

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->resource('rumahGadang');
    $routes->post('village', 'Village::getData');
    $routes->post('rumahGadang/findByRadius', 'RumahGadang::findByRadius');
    $routes->post('rumahGadang/findByName', 'RumahGadang::findByName');
    $routes->post('rumahGadang/findByFacility', 'RumahGadang::findByFacility');
    $routes->post('rumahGadang/findByCategory', 'RumahGadang::findByCategory');
    $routes->post('rumahGadang/findByRating', 'RumahGadang::findByRating');
    $routes->post('rumahGadang/recommendation', 'RumahGadang::recommendation');
    $routes->get('recommendationList', 'RumahGadang::recommendationList');
    $routes->post('recommendation', 'RumahGadang::updateRecommendation');
    $routes->resource('worshipPlace');
    $routes->resource('facilityTourismPackage');
    $routes->post('worshipPlace/findByRadius', 'WorshipPlace::findByRadius');
    $routes->resource('umkmPlace');
    $routes->post('umkmPlace/findByRadius', 'UmkmPlace::findByRadius');
    $routes->resource('souvenirPlace');
    $routes->post('souvenirPlace/findByRadius', 'SouvenirPlace::findByRadius');
    $routes->resource('study');
    $routes->post('study/findByRadius', 'Study::findByRadius');
    $routes->resource('historyPlace');
    $routes->post('historyPlace/findByRadius', 'HistoryPlace::findByRadius');
    $routes->resource('tourismObject');
    $routes->resource('tourismActivity');
    $routes->resource('packageActivities');
    $routes->post('tourismObject/findByRadius', 'TourismObject::findByRadius');
    $routes->resource('facilityRumahGadang');
    $routes->resource('tourismPackage');
    $routes->resource('account');
    $routes->post('account/profile', 'Account::profile');
    $routes->post('account/changePassword', 'Account::changePassword');
    $routes->resource('user');
    $routes->post('login', 'Profile::attemptLogin');
    $routes->post('profile', 'Profile::profile');
    $routes->post('account/visitHistory', 'Account::visitHistory');
    $routes->post('account/newVisitHistory', 'Account::newVisitHistory');
    $routes->get('logout', 'Profile::logout');
    $routes->get('booking', 'Booking::bookingHapus');
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
