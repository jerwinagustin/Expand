<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route - redirect to login
$routes->get('/', 'Auth::login');

// Authentication routes
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginProcess');
$routes->get('signup', 'Auth::signup');
$routes->post('signup', 'Auth::signupProcess');
$routes->get('logout', 'Auth::logout');

// Dashboard routes (protected)
$routes->get('dashboard', 'Dashboard::index');

// Page routes
$routes->get('transaction', 'Pages::transaction');
$routes->get('expense', 'Pages::expense');
$routes->get('report', 'Pages::report');
$routes->get('settings', 'Pages::settings');
