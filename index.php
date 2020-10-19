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
    echo "Welcome to 2iPaie API";
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
    $sql= "SELECT * FROM type_identite WHERE statut=1";
    $pdo = new db();
    $data = $pdo->query($sql);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: a single Identity
$app->get('/getIdentity/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM type_identite WHERE id_type_identite='$id'");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: add Identity
$app->post('/addIdentity', function (Request $request, Response $response, $args = []) {//AddIdentity
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO type_identite (libelle, user_create) VALUES (?,?)";
    $libelle = $request->getParam('libelle');
    $user = $request->getParam('user_create');
    $data = $pdo->prepare($sql, [$libelle, $user]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: update Identity
$app->post('/update/identity/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $libelle = $request->getParam('libelle');
    $date = new DateTime('now');
    $d = $date->format("Y-m-d h:i:s");
    $sql= "UPDATE type_identite SET libelle=?, update_at=? WHERE id_type_identite=?";
    $data = $pdo->prepare($sql, [$libelle, $d, $id]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: delete (logique) Identity
$app->post('/delete/identity/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $sql= "UPDATE type_identite SET statut=?, update_at=? WHERE id_type_identite=?";
    $pdo = new db();
    $date = new DateTime('now');
    $d = $date->format("Y-m-d h:i:s");
    $data = $pdo->prepare($sql,[0, $d, $id]);
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
//post: delete (logique) Pays
$app->post('/delete/pays/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $date = new DateTime('now');
    $d = $date->format("Y-m-d h:i:s");
    $sql= "UPDATE pays SET statut=?, update_at=? WHERE id_pays=?";
    $data = $pdo->prepare($sql, [0, $d, $id]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
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
    $data = $pdo->query("SELECT SUM(montant_transaction) as solde FROM transaction WHERE id_entreprise='$id' AND statut=1");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: Add Commission
$app->post('/addCommission', function (Request $request, Response $response, $args = []) {//AddCommission
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO commission (montant_debut, montant_fin, frais, taux, user_create) VALUES (?,?,?,?,?)";
    $montant_debut = $request->getParam('montant_debut');
    $montant_fin = $request->getParam('montant_fin');
    $frais = $request->getParam('frais');
    $taux = $request->getParam('taux');
    $user = $request->getParam('user_create');
    $data = $pdo->prepare($sql, [$montant_debut, $montant_fin, $frais, $taux, $user]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: All Commission
$app->get('/getCommissions', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM commission WHERE statut=1');
    return $response->write(json_encode($data))->withHeader('Content-type', 'application/json')->withStatus(200);
});
//get: a single Commission
$app->get('/getCommission/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM commission WHERE id_commission='$id'");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: update Commission
$app->post('/update/commission/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $montant_debut = $request->getParam('montant_debut');
    $montant_fin = $request->getParam('montant_fin');
    $frais = $request->getParam('frais');
    $taux = $request->getParam('taux');
    $date = new DateTime('now');
    $d = $date->format("Y-m-d h:i:s");
    $sql= "UPDATE commission SET montant_debut =?, montant_fin=?, frais=?, taux=?, update_at=? WHERE id_commission=?";
    $data = $pdo->prepare($sql, [$montant_debut, $montant_fin, $frais, $taux, $d, $id]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: delete (logique) Commission
$app->post('/delete/commission/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $date = new DateTime('now');
    $d = $date->format("Y-m-d h:i:s");
    $sql= "UPDATE commission SET statut=?, update_at=? WHERE id_commission=?";
    $data = $pdo->prepare($sql, [0, $d, $id]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: add STA
$app->post('/addSta', function (Request $request, Response $response, $args = []) {//AddIdentity
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO sta (nom, adresse, email, tel, bp, user_create) VALUES (?,?,?,?,?,?)";
    $nom = $request->getParam('nom');
    $adresse = $request->getParam('adresse');
    $email = $request->getParam('email');
    $bp = $request->getParam('bp');
    $tel = $request->getParam('tel');
    $user = $request->getParam('user_create');
    $data = $pdo->prepare($sql, [$nom, $adresse, $email, $tel, $bp, $user]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: All Stas
$app->get('/getStas', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM sta WHERE statut=1');
    return $response->write(json_encode($data))->withHeader('Content-type', 'application/json')->withStatus(200);
});
//post: update Sta
$app->post('/update/sta/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $nom = $request->getParam('nom');
    $adresse = $request->getParam('adresse');
    $email = $request->getParam('email');
    $bp = $request->getParam('bp');
    $tel = $request->getParam('tel');
    $date = new DateTime('now');
    $d = $date->format("Y-m-d h:i:s");
    $sql= "UPDATE sta SET nom=?, adresse=?, email=?, tel=?, bp=?, update_at=? WHERE id_sta=?";
    $data = $pdo->prepare($sql, [$nom, $adresse, $email, $tel, $bp, $d, $id]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: delete (logique) STA
$app->post('/delete/sta/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $sql= "UPDATE sta SET statut=?, update_at=? WHERE id_sta=?";
    $pdo = new db();
    $date = new DateTime('now');
    $d = $date->format("Y-m-d h:i:s");
    $data = $pdo->prepare($sql,[0, $d, $id]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: a single Sta
$app->get('/getSta/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM sta WHERE id_sta='$id'");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
$app->run();
