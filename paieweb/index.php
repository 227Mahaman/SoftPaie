<?php
session_start();
extract($_GET);
if (isset($_SESSION['user-auth'])) {
	include_once('views/paiement.php');
} elseif(!empty($p) && $p == "login"){

} else  {
	if (!empty($_POST)) {//
        $data = $_POST;
        $url = ROOT_PATH."index.php/signUpUser";
        $signUp = App::file_post_contents($url, $data);
        if($signUp){
            header('Location: index.php?p=login');
        }
    }
    require('views/login.php');
}
