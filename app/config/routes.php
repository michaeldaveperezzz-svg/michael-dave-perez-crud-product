<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/** @var object $router **/

$router->get('/login', 'AuthController::login');
$router->post('/login', 'AuthController::login');
$router->get('/logout', 'AuthController::logout');

$router->group(
    ['prefix' => '/products', 'middleware' => 'auth'],
    function ($router) {

        $router->get('/', 'ProductController::index');

        $router->get('/create', 'ProductController::create');
        $router->post('/create', 'ProductController::create');

        $router->get('/edit/{id}', 'ProductController::edit');
        $router->post('/edit/{id}', 'ProductController::edit');

        $router->get('/delete/{id}', 'ProductController::delete');
    }
);