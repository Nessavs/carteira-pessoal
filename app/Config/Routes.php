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

// CRUD de transações como recurso RESTful
$routes->resource('transacoes');

/*
|--------------------------------------------------------------------------
| CRUD de Categorias
|--------------------------------------------------------------------------
| Rotas protegidas por autenticação (opcional).
| Se o seu filtro de login se chama 'auth', descomente a linha abaixo.
*/
// $routes->group('categorias', ['filter' => 'auth'], function ($routes) {
$routes->group('categorias', function ($routes) {
    $routes->get('/',                'Categorias::index');       // listar
    $routes->get('criar',            'Categorias::create');      // form criar
    $routes->post('criar',           'Categorias::store');       // inserir
    $routes->get('editar/(:num)',    'Categorias::edit/$1');     // form editar
    $routes->post('editar/(:num)',   'Categorias::update/$1');   // atualizar
    $routes->get('excluir/(:num)',   'Categorias::delete/$1');   // remover
});

/*
|--------------------------------------------------------------------------
| Rotas de fallback
|--------------------------------------------------------------------------
| Se necessário, você pode definir uma rota 404 personalizada ou
| deixar que o CI4 trate automaticamente.
*/
