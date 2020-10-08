<?php
session_start();

use Slim\App;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use App\Database\db;

require 'vendor/autoload.php';
//$config = ['settings'=>['addContentLenghtHeader'=>false, 'displayErrorDetails'=>true]];
//$c = new \Slim\Container($config);
$app = new App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$app->get('/', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM users');
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get all users
$app->get('/getUsers', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM users');
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get a single user
$app->get('/getUser/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM users WHERE id='$id'");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//make a post request
$app->post('/addUser', function (Request $request, Response $response, $args = []) {//AddUser
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO users (pseudo, email, type_user) VALUES (?,?,?)";
    $pseudo = $request->getParam('pseudo');
    $email = $request->getParam('email');
    $type_user = $request->getParam('type_user');
    $data = $pdo->prepare($sql, [$pseudo, $email, $type_user]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//make a get request
$app->get('/deleteUser/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $sql= "DELETE from users where id='$id'";
    $pdo = new db();
    $data = $pdo->prepare($sql);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get all Identity
$app->get('/getIdentity', function (Request $request, Response $response) {//GET IDENTITY
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM identite');
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//make a post request add type user
$app->post('/addTypeUser', function (Request $request, Response $response, $args = []) {//AddTypeUser
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO type_users (label, role) VALUES (?,?)";
    $label = $request->getParam('label');
    $role = $request->getParam('role');
    $data = $pdo->prepare($sql, [$label, $role]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get all Type users
$app->get('/getTypeUser', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM type_users');
    return $response->write(json_encode($data))->withHeader('Content-type', 'application/json')->withStatus(200);
});
//get All Pays
$app->get('/getPays', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM pays');
    return $response->write(json_encode($data))->withHeader('Content-type', 'application/json')->withStatus(200);
});
//get All Entreprise Clients
$app->get('/getEntClients', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM entreprise WHERE statut=1');
    return $response->write(json_encode($data))->withHeader('Content-type', 'application/json')->withStatus(200);
});
//get AllTypeEntreprise
$app->get('/getTypeEntreprise', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM type_entreprise');
    return $response->write(json_encode($data))->withHeader('Content-type', 'application/json')->withStatus(200);
});

$app->run();
