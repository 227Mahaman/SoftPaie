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
//get: single Type user
$app->get('/getTypeUser/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM type_users WHERE id_typeuser='$id'");
    return $response->write(json_encode($data))->withHeader('Content-type', 'application/json')->withStatus(200);
});
//get All Pays
$app->get('/getAllPays', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM pays WHERE statut=1');
    return $response->write(json_encode($data))->withHeader('Content-type', 'application/json')->withStatus(200);
});
//post: Ajout Pays
$app->post('/addPays', function (Request $request, Response $response, $args = []) {//AddPays
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO pays (code, nom, user_create) VALUES (?,?,?)";
    $code = $request->getParam('code');
    $nom = $request->getParam('nom');
    $user = $request->getParam('user_create');
    $data = $pdo->prepare($sql, [$code, $nom, $user]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: Pays
$app->get('/getPays/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM pays WHERE id_pays='$id'");
    return $response->write(json_encode($data))->withHeader('Content-type', 'application/json')->withStatus(200);
});
//post: update Pays
$app->post('/update/pays/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $code = $request->getParam('code');
    $nom = $request->getParam('nom');
    $date = new DateTime('now');
    $d = $date->format("Y-m-d h:i:s");
    $sql= "UPDATE pays SET code =?, nom=?, update_at=? WHERE id_pays=?";
    $data = $pdo->prepare($sql, [$code, $nom, $d, $id]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
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
//post: Ajout TypeEntreprise
$app->post('/addTypeEnt', function (Request $request, Response $response, $args = []) {//AddTypeEntreprise
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO type_entreprise (libelle, user_create) VALUES (?,?)";
    $libelle = $request->getParam('libelle');
    $user = $request->getParam('user_create');
    $data = $pdo->prepare($sql, [$libelle, $user]);
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
//get: a single Entreprise
$app->get('/getTypeEntps/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM type_entreprise WHERE id_type_entreprise='$id'");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: update TypeEntreprise
$app->post('/update/typeEnt/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $libelle = $request->getParam('libelle');
    $date = new DateTime('now');
    $d = $date->format("Y-m-d h:i:s");
    $sql= "UPDATE type_entreprise SET libelle =?, update_at=? WHERE id_type_entreprise=?";
    $data = $pdo->prepare($sql, [$libelle, $d, $id]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: delete (logique) TypeEntreprise
$app->post('/delete/typeEnt/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $date = new DateTime('now');
    $d = $date->format("Y-m-d h:i:s");
    $sql= "UPDATE type_entreprise SET statut=?, update_at=? WHERE id_type_entreprise=?";
    $data = $pdo->prepare($sql, [0, $d, $id]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//make a post request Création de compte Entreprise
$app->post('/creationCompte', function (Request $request, Response $response, $args = []) {//Création de Compte Entreprise
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO entreprise (id_type_entreprise, id_type_identite, id_sta, id_pays, nom, adresse, email, bp, tel, n_identite, nom_identite, prenom_identite, reference, description, n_registration, website, localisation, user_create) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $type_entreprise = $request->getParam('id_type_entreprise');
    $identite = $request->getParam('id_type_identite');
    $sta = $request->getParam('id_sta');
    $pays = $request->getParam('id_pays');
    $nom = $request->getParam('nom');
    $adresse = $request->getParam('adresse');
    $email = $request->getParam('email');
    $bp = $request->getParam('bp');
    $tel = $request->getParam('tel');
    $nidentite = $request->getParam('n_identite');
    $nom_identite = $request->getParam('nom_identite');
    $prenom_identite = $request->getParam('prenom_identite');
    $reference = $request->getParam('reference');
    $description = $request->getParam('description');
    $nregistration = $request->getParam('n_registration');
    $website = $request->getParam('website');
    $localisation = $request->getParam('localisation');
    $user_create = $request->getParam('user_create');
    $data = $pdo->prepare($sql, [$type_entreprise, $identite, $sta, $pays, $nom, $adresse, $email, $bp, $tel, $nidentite, $nom_identite, $prenom_identite, $reference, $description, $nregistration, $website, $localisation, $user_create]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: Création de compte Client
$app->post('/creationCclient', function (Request $request, Response $response, $args = []) {//Création de Compte Client
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO client (id_sta, nom, prenom, tel, adresse, email, user_create) VALUES (?,?,?,?,?,?,?)";
    $sta = $request->getParam('id_sta');
    $nom = $request->getParam('nom');
    $prenom = $request->getParam('prenom');
    $tel = $request->getParam('tel');
    $adresse = $request->getParam('adresse');
    $email = $request->getParam('email');
    $user_create = $request->getParam('user_create');
    $data = $pdo->prepare($sql, [$sta, $nom, $prenom, $tel, $adresse, $email, $user_create]);
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
//get: Count Entreprise Clients
$app->get('/countEntClients', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT COUNT(id_entreprise) as total FROM entreprise WHERE statut=1");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: Count Entreprise Clients
$app->get('/countUsers', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT COUNT(id) as total FROM users WHERE statut=1");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: Count Transactions
$app->get('/countTransactions', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT COUNT(id_transaction) as total FROM transaction WHERE statut=1");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: Count Transactions
$app->get('/countStas', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT COUNT(id_sta) as total FROM sta WHERE statut=1");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: All Clients
$app->get('/getClients', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM client WHERE statut=1');
    return $response->write(json_encode($data))->withHeader('Content-type', 'application/json')->withStatus(200);
});
//get: a single Client
$app->get('/getClient/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM client WHERE id_client='$id'");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: Transaction
$app->post('/paiement', function (Request $request, Response $response, $args = []) {//AddIdentity
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO transaction (id_client, id_entreprise, id_commission, id_sta, montant_transaction) VALUES (?,?,?,?,?)";
    $client = $request->getParam('id_client');
    $entreprise = $request->getParam('id_entreprise');
    $commission = $request->getParam('id_commission');
    $sta = $request->getParam('id_sta');
    $montant = $request->getParam('montant_transaction');
    $data = $pdo->prepare($sql, [$client, $entreprise, $commission, $sta, $montant]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: selected
$app->get('/{table}/{field}/{value}/{field2}/{value2}', function (Request $request, Response $response) {
    $table = $request->getAttribute('table');
    $field = $request->getAttribute('field');
    $value = $request->getAttribute('value');
    $field2 = $request->getAttribute('field2');
    $value2 = $request->getAttribute('value2');
    //$sql = "SELECT * FROM ? WHERE ?=? AND ?=?";
    $pdo = new db();
$data = $pdo->query("SELECT * FROM $table WHERE $field='$value' AND $field2='$value2'");
    //$data = $pdo->prepare($sql, [$table, $field, $value, $field2, $value2]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: action by profil
$app->get('/getActionProfil/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM action a, profil_has_action p, type_users t WHERE a.id_action=p.id_action AND p.id_profil=t.id_typeuser AND t.id_typeuser='$id'");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: action by profil en fonction de l'action 
$app->get('/getActionProfil/{action}/{profil}', function (Request $request, Response $response, $args = []) {
    $action = $request->getAttribute('action');
    $profil = $request->getAttribute('profil');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM action a, profil_has_action p, type_users t WHERE a.id_action='$action' AND a.id_action=p.id_action AND p.id_profil=t.id_typeuser AND t.id_typeuser='$profil'");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: all modules
$app->get('/getModules', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM groupe_action WHERE statut=1');
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: module
$app->get('/getModule/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM groupe_action WHERE id_groupe='$id' AND statut=1");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: all  action (menu)
$app->get('/getActions', function (Request $request, Response $response) {
    $pdo = new db();
    $data = $pdo->query('SELECT * FROM action WHERE statut=1');
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: menu
$app->get('/getMenu/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $data = $pdo->query("SELECT * FROM action WHERE id_action='$id' AND statut=1");
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: add Menu
$app->post('/addMenu', function (Request $request, Response $response, $args = []) {//AddMenu Action
    //get db object
    $pdo = new db();
    $sql = "INSERT INTO action (id_groupe, libelle_action, description_action, url_action, ordre_affichage_action) VALUES (?,?,?,?,?)";
    $groupe = $request->getParam('id_groupe');
    $libelle_action = $request->getParam('libelle_action');
    $description_action = $request->getParam('description_action');
    $url_action = $request->getParam('url_action');
    $ordre = $request->getParam('ordre_affichage_action');
    $data = $pdo->prepare($sql, [$groupe, $libelle_action, $description_action, $url_action, $ordre]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//post: update Menu
$app->post('/update/menu/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $pdo = new db();
    $groupe = $request->getParam('id_groupe');
    $libelle_action = $request->getParam('libelle_action');
    $description_action = $request->getParam('description_action');
    $url_action = $request->getParam('url_action');
    $ordre = $request->getParam('ordre_affichage_action');
    $sql= "UPDATE action SET id_groupe=?, libelle_action=?, description_action=?, url_action=?, ordre_affichage_action=? WHERE id_action=?";
    $data = $pdo->prepare($sql, [$groupe, $libelle_action, $description_action, $url_action, $ordre, $id]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
//get: delete (logique) menu
$app->get('/delete/menu/{id}', function (Request $request, Response $response, $args = []) {
    $id = $request->getAttribute('id');
    $sql= "UPDATE action SET statut=?, update_at=? WHERE id_action=?";
    $pdo = new db();
    $date = new DateTime('now');
    $d = $date->format("Y-m-d h:i:s");
    $data = $pdo->prepare($sql,[0, $d, $id]);
    return $response->write(json_encode($data))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
$app->run();
