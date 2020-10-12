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
    $data = $pdo->query('SELECT * FROM users WHERE statut=1');
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
//make a post request
$app->post('/signUpUser', function (Request $request, Response $response, $args = []) {//AddUser
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO users (pseudo, email, mot_pass, type_user) VALUES (?,?,?,?)";
    $pseudo = $request->getParam('pseudo');
    $email = $request->getParam('email');
    $mot_pass = sha1($request->getParam('mot_pass'));
    $type_user = $request->getParam('type_user');
    $data = $pdo->prepare($sql, [$pseudo, $email, $mot_pass, $type_user]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//make a get request
$app->post('/update/user/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $pseudo = $request->getParam('pseudo');
    $email = $request->getParam('email');
    $type_user = $request->getParam('type_user');
    $date = new DateTime('now');
    $d = $date->format("Y-m-d h:i:s");
    $sql= "UPDATE users SET pseudo =?, email=?, type_user=?, updated_at=? WHERE id=?";
    $data = $pdo->prepare($sql, [$pseudo, $email, $type_user, $d, $id]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//make a get request
$app->get('/deleteUser/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $sql= "UPDATE users SET statut=2 WHERE id=?";
    $pdo = new db();
    $data = $pdo->prepare($sql,[$id]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get all Identity
$app->get('/getIdentites', function (Request $request, Response $response) {//GET IDENTITY
    $sql= "SELECT * FROM identite";
    $pdo = new db();
    $data = $pdo->query($sql);
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
    //var_dump($data);
    //var_dump($response->write(json_encode($data))->withHeader('Content-type', 'application/json')->withStatus(200));
    //die();
    return $response->write(json_encode($data))->withHeader('Content-type', 'application/json')->withStatus(200);
});
//get a single Entreprise
$app->get('/getEntreprise/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM entreprise WHERE id_entreprise='$id'");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get AllTypeEntreprise
$app->get('/getTypeEntreprise', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM type_entreprise');
    return $response->write(json_encode($data))->withHeader('Content-type', 'application/json')->withStatus(200);
});
//make a post request Création de compte Entreprise
$app->post('/creationCompte', function (Request $request, Response $response, $args = []) {//Création de Compte Entreprise
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO entreprise (type_entreprise, identite, pays, nom, adresse, email, bp, tel, nidentite, reference, description, nregistration, website, localisation, user_create) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $type_entreprise = $request->getParam('type_entreprise');
    $identite = $request->getParam('identite');
    $pays = $request->getParam('pays');
    $nom = $request->getParam('nom');
    $adresse = $request->getParam('adresse');
    $email = $request->getParam('email');
    $bp = $request->getParam('bp');
    $tel = $request->getParam('tel');
    $nidentite = $request->getParam('nidentite');
    $reference = $request->getParam('reference');
    $description = $request->getParam('description');
    $nregistration = $request->getParam('nregistration');
    $website = $request->getParam('website');
    $localisation = $request->getParam('localisation');
    $user_create = $request->getParam('user_create');
    $data = $pdo->prepare($sql, [$type_entreprise, $identite, $pays, $nom, $adresse, $email, $bp, $tel, $nidentite, $reference, $description, $nregistration, $website, $localisation, $user_create]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get MyTransaction
$app->get('/getMyTransaction/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM transaction WHERE id_entreprise='$id'");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get Solde Compte
$app->get('/getSolde/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT SUM(montant_transaction) as solde FROM transaction WHERE id_entreprise='$id'");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});

$app->run();
