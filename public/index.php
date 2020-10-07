<?php
//session_start();
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
                    var_dump($data);//index.php/getUsers
                    $url = ROOT_PATH."index.php/addUser";
                    $add = App::file_post_contents($url, $data);
                    var_dump($add);
                    die();
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
        $user = $pdo->prepare("SELECT * FROM users where pseudo=? and mot_pass=?", [$data['pseudo'], $pass]);
        if (!isset($user)) {
            $_SESSION['messages'] = $user;
        } else {
            $_SESSION['user-auth']['id'] = $user['0']['id'];
            $_SESSION['user-auth']['pseudo'] = $user['0']['pseudo'];
            header('Location: index.php?p=dashboard');
        }
    }
    require('../app/views/view_login.php');
}