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
            //$routes = "/api/lsts";
            //$datas = file_get_contents('/api/lsts');
            //json_decode($datas);
            //var_dump($datas);
            //die();
            include_once('../app/views/view_lstUsers.php');
        } elseif($p == "addUser"){
            include_once('../app/views/view_addUser.php');
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