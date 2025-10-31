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

// Home routes
$routes->get('home', 'Home::index');
$routes->post('home/addBalance', 'Home::addBalance');

// Page routes
$routes->get('transaction', 'Pages::transaction');
$routes->get('expense', 'Expense::index');
$routes->get('report', 'Pages::report');
$routes->get('settings', 'Pages::settings');

// Expense API routes
$routes->post('expense/add', 'Expense::addCategory');
$routes->get('expense/get/(:num)', 'Expense::getCategory/$1');
$routes->post('expense/update/(:num)', 'Expense::updateCategory/$1');
$routes->post('expense/delete/(:num)', 'Expense::deleteCategory/$1');
$routes->get('expense/list', 'Expense::getCategories');
$routes->post('expense/addExpense', 'Expense::addExpense');
$routes->get('expense/test', 'Expense::test');
