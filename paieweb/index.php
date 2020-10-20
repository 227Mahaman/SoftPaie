<?php
session_start();
use App\Database\db;

require '../app/App.php';
//require '../index.php';
require '../app/global.php';
App::load();
extract($_GET);
if (isset($_SESSION['user-auth'])) {
	if(!empty($_GET['p'])){
		if ($p == "paiement") {//Paiement
			if (!empty($_POST)) {//
				$data = $_POST;
				$data['id_client'] = $_SESSION['user-auth']['client'];
				$url = ROOT_PATH."index.php/paiement";
				$add = App::file_post_contents($url, $data);
				//die(var_dump($add));
				if($add){
					session_destroy();
					header('Location: index.php?p=message');
				} else {
					header('Location: index.php?p=message');
				}
			}
            include_once('views/paiement.php');
        }
	}
	include_once('views/login.php');
} elseif(!empty($p) && $p == "login"){
	include_once('views/login.php');
} else  {
	if (!empty($_POST)) {//Connexion
        $data = $_POST;
        $pass = sha1($data['mot_pass']);
        $pdo = new db();
		$user = $pdo->prepare("SELECT * FROM users WHERE pseudo=? AND mot_pass=?", [$data['pseudo'], $pass]);
		if (empty($user)) {
			die('Acces denied');
            $_SESSION['messages'] = "Erreur authentification";
        } else {
			$_SESSION['user-auth']['id'] = $user['0']['id'];
            $_SESSION['user-auth']['pseudo'] = $user['0']['pseudo'];
            $type= $pdo->prepare("SELECT * FROM type_users where id_typeuser=?", [$user['0']['type_user']]);
			$_SESSION['user-auth']['typeUser'] = $type['0']['label'];
			$compteClient = $pdo->prepare("SELECT * FROM client WHERE statut=1 AND user_create=?", [$id]);
            $_SESSION['user-auth']['client'] = $compteClient['0']['id_client'];//ID Client récuperé
			if($_SESSION['user-auth']['typeUser']==="Client"){//Verification si c'est un Client
                header('Location: index.php?p=paiement');
            }
		}
    }
    require('views/login.php');
}
