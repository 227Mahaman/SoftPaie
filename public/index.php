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
        //extract($_GET);
        if ($p == "dashboard") {
            include_once('../app/views/view_dashboard.php');
        } elseif($p == "deconnexion"){
            include_once('../app/views/view_deconnexion.php');
        } elseif($p == "compte"){//(Compte | Profil) Entreprise
            if(!empty($_POST)){//Renseignez les informations de l'entreprise
                $data = $_POST;
                $data['user_create'] = $_SESSION['user-auth']['id'];
                $url = ROOT_PATH."index.php/creationCompte";
                $add = App::file_post_contents($url, $data);
                if($add){
                    header('Location: index.php?p=dashboard');
                }
            }
            include_once('../app/views/view_compteEnt.php');
        } elseif($p == "login"){//Se connecter au plateforme
            include_once('../app/views/view_loginIn.php');
        } elseif($p == "profil"){//My Profil
            include_once('../app/views/view_myProfil.php');
        } elseif($p == "lstUser"){
                if(!empty($_POST)){//Suppression User
                    $id = $_POST['id'];
                    $url = ROOT_PATH."index.php/deleteUser/".$id;
                    $delete = file_get_contents($url);
                    //var_dump($delete);
                    //die();
                    if($delete){
                        $_SESSION['message'] = "Opération reussi !!";
                    } else {
                        $_SESSION['message'] = "Echec de l'opération!!";
                    }
                }
            include_once('../app/views/view_lstUsers.php');
        } elseif($p == "addUser"){
            if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {//Modif User
                if (!empty($_POST)) {
                    $data = $_POST;
                    $id=$_GET['modif'];
                    $url = ROOT_PATH."index.php/update/user/".$id;
                    $update = App::file_post_contents($url, $data);
                    if($update){
                        header('Location: index.php?p=lstUser');
                    }
                }
            } else { // Ajout User
                if (!empty($_POST)) {
                    $data = $_POST;
                    $url = ROOT_PATH."index.php/addUser";
                    $add = App::file_post_contents($url, $data);
                    if($add){
                        header('Location: index.php?p=lstUser');
                    }
                }
            }
            include_once('../app/views/view_addUser.php');
        } elseif($p == "identite"){//View Identité
            if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {//Modif Identity
                if (!empty($_POST)) {
                    $data = $_POST;
                    $url = ROOT_PATH."index.php/update/identity/".$_GET['modif'];
                    $update = App::file_post_contents($url, $data);
                    if($update){
                        header('Location: index.php?p=identite');
                    }
                }
            } else {
                if(!empty($_POST)){
                    $id = $_POST['id_identite'];
                    if(isset($id)){//Suppression (Logique) Identité
                        $url = ROOT_PATH."index.php/delete/identity/".$id;
                        $delete = file_get_contents($url);
                        if($delete){
                            $_SESSION['message'] = "Opération reussi !!";
                        } else {
                            $_SESSION['message'] = "Echec de l'opération!!";
                        }
                    } else {//Ajout Identité
                        $data = $_POST;
                        $data['user_create'] = $_SESSION['user-auth']['id'];
                        $url = ROOT_PATH."index.php/addIdentity";
                        $add = App::file_post_contents($url, $data);
                        if($add){
                            header('Location: index.php?p=identite');
                        }
                    }
                }
            }
        include_once('../app/views/view_identite.php');
        } elseif($p == "lstTypeUser"){
            if(!empty($_POST)){//Suppression TypeUser
                $id = $_POST['id_typeuser'];
                $url = ROOT_PATH."index.php/deleteTypeUser/".$id;
                $delete = file_get_contents($url);
                if($delete){
                    $_SESSION['message'] = "Opération reussi !!";
                } else {
                    $_SESSION['message'] = "Echec de l'opération!!";
                }
            }
            include_once('../app/views/view_lstTypeUser.php');
        } elseif($p == "lstPays"){
            if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {//Modif Pays
                if (!empty($_POST)) {
                    $data = $_POST;
                    $url = ROOT_PATH."index.php/update/pays/".$_GET['modif'];
                    $update = App::file_post_contents($url, $data);
                    if($update){
                        header('Location: index.php?p=lstPays');
                    }
                }
            } else {
                if(!empty($_POST)){
                    $id = $_POST['id_pays'];
                    if(isset($id)){//Suppression (Logique) Pays
                        $url = ROOT_PATH."index.php/delete/pays/".$id;
                        $delete = file_get_contents($url);
                        if($delete){
                            $_SESSION['message'] = "Opération reussi !!";
                        } else {
                            $_SESSION['message'] = "Echec de l'opération!!";
                        }
                    } else {//Ajout Pays
                        $data = $_POST;
                        $data['user_create'] = $_SESSION['user-auth']['id'];
                        $url = ROOT_PATH."index.php/addPays";
                        $add = App::file_post_contents($url, $data);
                        if($add){
                            header('Location: index.php?p=lstPays');
                        }
                    }
                }
            }
            include_once('../app/views/view_lstPays.php');
        } elseif($p == "lstEntClt"){//View Liste Entreprise Client 
            if(!empty($_POST)){//Suppression Entreprise Clients
                $id = $_POST['id_entreprise'];
                $url = ROOT_PATH."index.php/deleteEntClt/".$id;
                $delete = file_get_contents($url);
                if($delete){
                    $_SESSION['message'] = "Opération reussi !!";
                } else {
                    $_SESSION['message'] = "Echec de l'opération!!";
                }
            }
            include_once('../app/views/view_lstEntClient.php');
        } elseif($p == "lstTypeEnt"){//View Liste TypeEntreprise 
            if(!empty($_POST)){//Suppression Type Entreprise
                $id = $_POST['id_entreprise'];
                $url = ROOT_PATH."index.php/deleteTypeEnt/".$id;
                $delete = file_get_contents($url);
                if($delete){
                    $_SESSION['message'] = "Opération reussi !!";
                } else {
                    $_SESSION['message'] = "Echec de l'opération!!";
                }
            }
            include_once('../app/views/view_lstTypeEnt.php');
        } elseif($p == "addTypeUser"){
            if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {//Modif TypeUser
                if (!empty($_POST)) {
                    $data = $_POST;
                    $url = ROOT_PATH."update/type/user/".$_GET['modif'];
                    $update = App::file_post_contents($url, $data);
                    if($update){
                        header('Location: index.php?p=lstTypeUser');
                    }
                }
            } else { // Ajout TypeUser
                if (!empty($_POST)) {
                    $data = $_POST;
                    $url = ROOT_PATH."index.php/addTypeUser";
                    $add = App::file_post_contents($url, $data);
                    if($add){
                        header('Location: index.php?p=lstTypeUser');
                    }
                }
            }
            include_once('../app/views/view_addTypeUser.php');
        } elseif($p == "transaction"){//View Transaction
            $id = $_SESSION['user-auth']['entreprise'];
            include_once('../app/views/view_transaction.php');
        } elseif($p == "lstCommission"){//View Liste Commission
            if (!empty($_POST)) {//Suppression logique
                $id = $_POST['id_commission'];
                $url = ROOT_PATH."index.php/delete/commission/".$id;
                $update = App::file_post_contents($url, $data);
                if($update){
                    header('Location: index.php?p=lstCommission');
                }
            }
            include_once('../app/views/view_lstCommission.php');
        } elseif($p == "addCommission"){// Ajout Commission
            if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {//Modif Commission
                if (!empty($_POST)) {
                    $data = $_POST;
                    $url = ROOT_PATH."update/commission/".$_GET['modif'];
                    $update = App::file_post_contents($url, $data);
                    if($update){
                        header('Location: index.php?p=lstCommission');
                    }
                }
            } else { // Ajout Commission
                if (!empty($_POST)) {
                    $data = $_POST;
                    $data['user_create'] = $_SESSION['user-auth']['id'];
                    $url = ROOT_PATH."index.php/addCommission";
                    $add = App::file_post_contents($url, $data);
                    if($add){
                        header('Location: index.php?p=lstCommission');
                    }
                }
            }
            include_once('../app/views/view_addCommission.php');
        } elseif($p == "sta"){//View STA Dépôt
            if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {//Modif STA Dépôt
                if (!empty($_POST)) {
                    $data = $_POST;
                    $url = ROOT_PATH."index.php/update/sta/".$_GET['modif'];
                    $update = App::file_post_contents($url, $data);
                    if($update){
                        header('Location: index.php?p=sta');
                    }
                }
            } else {
                if(!empty($_POST)){
                    $id = $_POST['id_sta'];
                    if(isset($id)){//Suppression (Logique) STA Dépôt
                        $url = ROOT_PATH."index.php/delete/sta/".$id;
                        $delete = file_get_contents($url);
                        if($delete){
                            $_SESSION['message'] = "Opération reussi !!";
                        } else {
                            $_SESSION['message'] = "Echec de l'opération!!";
                        }
                    } else {//Ajout STA Dépôt
                        $data = $_POST;
                        $data['user_create'] = $_SESSION['user-auth']['id'];
                        $url = ROOT_PATH."index.php/addSta";
                        $add = App::file_post_contents($url, $data);
                        if($add){
                            header('Location: index.php?p=sta');
                        }
                    }
                }
            }
        include_once('../app/views/view_depot.php');
        }
    } else{
        include_once('../app/views/view_dashboard.php');
    }
} elseif(!empty($p) && $p == "login"){
    if (!empty($_POST)) {
        $data = $_POST;
        $pass = sha1($data['mot_pass']);
        $pdo = new db();
        $user = $pdo->prepare("SELECT * FROM users WHERE pseudo=? AND mot_pass=?", [$data['pseudo'], $pass]);
        //var_dump($user);die();
        if (empty($user)) {
            $_SESSION['messages'] = "Erreur authentification";
        } else {
            $_SESSION['user-auth']['id'] = $user['0']['id'];
            $_SESSION['user-auth']['pseudo'] = $user['0']['pseudo'];
            $type= $pdo->prepare("SELECT * FROM type_users where id_typeuser=?", [$user['0']['type_user']]);
            $_SESSION['user-auth']['typeUser'] = $type['0']['label'];
            //header('Location: index.php?p=dashboard');
            if($_SESSION['user-auth']['typeUser']==="Administrateur"){//Verification si c'est un Administrateur
                header('Location: index.php?p=dashboard');
            } else {
                $compte = $pdo->prepare("SELECT * FROM entreprise WHERE statut=1 AND user_create=?", [$_SESSION['user-auth']['id']]);
                $_SESSION['user-auth']['entreprise'] = $compte['0']['id_entreprise'];//ID Entreprise
                if(!isset($compte)){//Vérification (Si l'utilisateur n'a pas de compte entreprise)
                    header('Location: index.php?p=compte');
                } else {
                    header('Location: index.php?p=dashboard');
                }   
            }
        }
    }
    include_once('../app/views/view_loginIn.php');
} else {
    if (!empty($_POST)) {//Inscription à la plateforme
        $data = $_POST;
        $data['type_user'] = 2; 
        $url = ROOT_PATH."index.php/signUpUser";
        $signUp = App::file_post_contents($url, $data);
        if($signUp){
            header('Location: index.php?p=login');
        }
    }
    require('../app/views/view_signUp.php');
}