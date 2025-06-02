<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->post('/login', 'AuthController::doLogin');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::doRegister');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/dashboard', 'TransacaoController::dashboard');
$routes->resource('transacoes');

