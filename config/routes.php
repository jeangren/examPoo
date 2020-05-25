<?php

use Bramus\Router\Router;

$router = new Router();
$router->setNamespace('App\Controller');

/**
 * Insérez vos routes ici
 */
$router->get('/', 'AppController@index');
$router->get('/conducteur', 'ConducteurController@index');
$router->get('/conducteur/(\d+)', 'ConducteurController@show');
$router->get('/conducteur/create', 'ConducteurController@create');
$router->post('/conducteur', 'ConducteurController@new');
$router->get('/conducteur/(\d+)/edit', 'ConducteurController@edit');
$router->post('/conducteur/(\d+)/edit', 'ConducteurController@update');
$router->post('/conducteur/(\d+)/delete', 'ConducteurController@delete');


$router->run();

