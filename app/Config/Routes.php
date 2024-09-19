<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Main::index');
$routes->post('/', 'Main::index');
$routes->get('/notes/get/(:num)', 'Main::getNote/$1');
$routes->get('/notes/create', 'Main::addNote');
$routes->post('/notes/create', 'Main::addNote');
$routes->get('/notes/delete/(:num)', 'Main::deleteNote/$1');
$routes->post('/notes/update/(:num)', 'Main::addNote/$1');
$routes->get('/notes/update/(:num)', 'Main::addNote/$1');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/login/google', 'Auth::loginWithGoogle');
$routes->get('/auth/callback', 'Auth::callback');

$routes->get('/logout', 'Auth::logout');

$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/register/google', 'Auth::registerWithGoogle');

$routes->get('/profile', 'Profile::index');
$routes->post('/profile', 'Profile::index');
$routes->post('/profile/image', 'Profile::updateImage');


