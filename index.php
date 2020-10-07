<?php
session_start();
//

use App\API\Controller\UserAPIController;
use Slim\App;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use App\Database\db;
use App\Controllers\UsersController;

require 'vendor/autoload.php';
//$config = ['settings'=>['addContentLenghtHeader'=>false, 'displayErrorDetails'=>true]];
//$c = new \Slim\Container($config);
$app = new App;

$app->get('/', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM users');
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});

//get all users
$app->get('/api/users', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM users');
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
$app->get('/getUsers', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM users');
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});


//get a single user
$app->get('/api/users/{id}', function (Request $request, Response $reponse, array $args) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM users WHERE id='$id'");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});


//make a post request
$app->post('/api/users/add', function (Request $request, Response $reponse, array $args) {
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $address = $request->getParam('address');
    $city = $request->getParam('city');
    $state = $request->getParam('state');

    try {
        //get db object
        $db = new db();
        //conncect
        $pdo = $db->connect();


        $sql = "INSERT INTO users (first_name, last_name, phone,email,address,city,state) VALUES (?,?,?,?,?,?,?)";


        $pdo->prepare($sql)->execute([$first_name, $last_name, $phone, $email, $address, $city, $state]);

        echo '{"notice": {"text": "User '. $first_name .' has been just added now"}}';
        $pdo = null;
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

//make a post request
$app->put('/api/users/update/{id}', function (Request $request, Response $reponse, array $args) {
    $id = $request->getAttribute('id');

    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');

    try {
        //get db object
        $db = new db();
        //conncect
        $pdo = $db->connect();


        $sql = "UPDATE  users SET first_name =?, last_name=?, phone=? WHERE id=?";


        $pdo->prepare($sql)->execute([$first_name, $last_name, $phone, $id]);

        echo '{"notice": {"text": "User '. $first_name .' has been just updated now"}}';
        $pdo = null;
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});


//make a post request
$app->delete('/api/users/delete/{id}', function (Request $request, Response $reponse, array $args) {
    $id = $request->getAttribute('id');

    try {
        //get db object
        $db = new db();
        //conncect/RE id=?";

        $pdo->prepare($sql)->execute([$id]);
        $pdo = null;

        echo '{"notice": {"text": "User with '. $id .' has been just deleted now"}}';

    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});
 


$app->run();
