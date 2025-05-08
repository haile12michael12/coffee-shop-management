<?php

use App\Core\Router;

// Public routes
Router::get('/', 'HomeController@index');
Router::get('/menu', 'MenuController@index');
Router::get('/menu/{id}', 'MenuController@show');

// Authentication routes
Router::get('/login', 'AuthController@loginForm');
Router::post('/login', 'AuthController@login');
Router::get('/register', 'AuthController@registerForm');
Router::post('/register', 'AuthController@register');
Router::get('/logout', 'AuthController@logout');

// Customer routes
Router::get('/orders', 'OrderController@index');
Router::post('/orders', 'OrderController@store');
Router::get('/orders/{id}', 'OrderController@show');

// Admin routes
Router::get('/admin', 'AdminController@dashboard');
Router::get('/admin/menu', 'AdminController@menu');
Router::post('/admin/menu', 'AdminController@storeMenuItem');
Router::put('/admin/menu/{id}', 'AdminController@updateMenuItem');
Router::delete('/admin/menu/{id}', 'AdminController@deleteMenuItem');

Router::get('/admin/orders', 'AdminController@orders');
Router::put('/admin/orders/{id}', 'AdminController@updateOrderStatus');

Router::get('/admin/users', 'AdminController@users');
Router::post('/admin/users', 'AdminController@storeUser');
Router::put('/admin/users/{id}', 'AdminController@updateUser');
Router::delete('/admin/users/{id}', 'AdminController@deleteUser');
