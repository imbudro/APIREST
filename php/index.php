<?php
use Slim\Factory\AppFactory;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';
require __DIR__ . '/controllers/CertificazioniController.php';

$app = AppFactory::create();

$app->get('/test', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Test page");
    return $response;
});

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->get('/alunni/', "AlunniController:index");
//GET
$app->get('/alunni/{id}', "AlunniController:show");
//POST
$app->post('/alunni', "AlunniController:create");
//PUT
$app->put('/alunni/{id}', "AlunniController:update");
//DELETE
$app->delete('/alunni/{id}', "AlunniController:destroy");


$app->get('/certificazioni/', "CertificazioniController:index");
//GET
$app->get('/alunni/{id}/certificazioni/', "CertificazioniController:show");
//POST
$app->post('/certificazioni', "CertificazioniController:create");
//PUT
$app->put('/certificazioni/{id}', "CertificazioniController:update");
//DELETE
$app->delete('/certificazioni/{id}', "CertificazioniController:destroy");




$app->run();
