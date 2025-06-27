<?php

use CodeIgniter\Router\RouteCollection;

/**
 * --------------------------------------------------------------------
 * Roteamento principal da aplicação
 * --------------------------------------------------------------------
 *
 * Qualquer rota adicionada aqui estará disponível
 * quando o ambiente de desenvolvimento iniciar.
 *
 * @var RouteCollection $routes
 */
$routes->get('/',            'AuthController::login');
$routes->post('/login',      'AuthController::doLogin');
$routes->get('/register',    'AuthController::register');
$routes->post('/register',   'AuthController::doRegister');
$routes->get('/logout',      'AuthController::logout');

$routes->get('/dashboard',   'TransacaoController::dashboard');

$routes->group('transacoes', function ($routes) {
    $routes->get('/',                'TransacaoController::index');
    $routes->get('criar',            'TransacaoController::create');
    $routes->post('criar',           'TransacaoController::store');
    $routes->get('editar/(:num)',    'TransacaoController::edit/$1');
    $routes->post('editar/(:num)',   'TransacaoController::update/$1');
    $routes->get('excluir/(:num)',   'TransacaoController::delete/$1');
});

$routes->group('categorias', function ($routes) {
    $routes->get('/',                'Categorias::index');
    $routes->get('criar',            'Categorias::create');
    $routes->post('criar',           'Categorias::store');
    $routes->get('editar/(:num)',    'Categorias::edit/$1');
    $routes->post('editar/(:num)',   'Categorias::update/$1');
    $routes->get('excluir/(:num)',   'Categorias::delete/$1');
});

/*
|--------------------------------------------------------------------------
| Rotas de fallback
|--------------------------------------------------------------------------
| Se necessário, você pode definir uma rota 404 personalizada ou
| deixar que o CI4 trate automaticamente.
*/
