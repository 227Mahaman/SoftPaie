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
$app->get('/getUser/{id}', function (Request $request, Response $response, array $args) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM users WHERE id='$id'");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});


//make a post request
$app->post('/addUser', function (Request $request, Response $response, array $args) {//AddUser
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO users (pseudo, email, type_user) VALUES (?,?,?)";
    //$pseudo = $request->getParam('pseudo');
    //$email = $request->getParam('email');
    //$type_user = $request->getParam('type_user');
    $data = $pdo->prepare($sql)->execute($request->getParsedBody());
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//make a get request
$app->get('/deleteUser/{id}', function (Request $request, Response $response, array $args) {
    $id = $request->getAttribute('id');
    $sql= "DELETE from users where id='$id'";
    $pdo = new db();
    $data = $pdo->prepare($sql);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});

//make a post request
$app->put('/api/users/update/{id}', function (Request $request, Response $response, array $args) {
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
$app->delete('/api/users/delete/{id}', function (Request $request, Response $response, array $args) {
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
