<?php
session_start();
use App\Database\db;

require '../app/App.php';
//require '../index.php';
require '../app/global.php';
App::load();

if (isset($_SESSION['user-auth'])) {
    if(!empty($_GET['p'])){
        extract($_GET);
        if ($p == "dashboard") {
            include_once('../app/views/view_dashboard.php');
        } elseif($p == "login"){
            include_once('../app/views/view_login.php');
        } elseif($p == "deconnexion"){
            include_once('../app/views/view_deconnexion.php');
        } elseif($p == "login"){
            include_once('../app/views/view_login.php');
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
                    $url = ROOT_PATH."update/user/".$_GET['modif'];
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
            if(!empty($_POST)){//Suppression Identité
                $id = $_POST['id_identite'];
                $url = ROOT_PATH."index.php/deleteIdentity/".$id;
                $delete = file_get_contents($url);
                if($delete){
                    $_SESSION['message'] = "Opération reussi !!";
                } else {
                    $_SESSION['message'] = "Echec de l'opération!!";
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
            if(!empty($_POST)){//Suppression Pays
                $id = $_POST['id_pays'];
                $url = ROOT_PATH."index.php/deletePays/".$id;
                $delete = file_get_contents($url);
                if($delete){
                    $_SESSION['message'] = "Opération reussi !!";
                } else {
                    $_SESSION['message'] = "Echec de l'opération!!";
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
        }
    } else{
        include_once('../app/views/view_dashboard.php');
    }
} elseif (isset($_GET['signup'])) {
    if (!empty($_POST)) {

        // $res = UserManager::connectUser($_POST);
        // if ($res != 1) {
        //     $_SESSION['messages'] = $res;
        // } else {
        //     header('Location: index.php?action=profile');
        // }
    }
    require('../app/views/view_login.php');
} else {
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
            header('Location: index.php?p=dashboard');
        }
    }
    require('../app/views/view_login.php');
}