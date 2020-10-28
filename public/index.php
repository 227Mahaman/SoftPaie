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
        if ($p == "dashboard") {//Dashboard CLient
            include_once('../app/views/view_dashboard.php');
        } elseif($p == "dashBoard"){//Dashboard Administrateur
            include_once('../app/views/view_dashBoard.php');
        } elseif($p == "deconnexion"){
            include_once('../app/views/view_deconnexion.php');
        } elseif($p == "compte"){//(Compte | Profil) Entreprise
            if(!empty($_POST)){//Renseignez les informations de l'entreprise
                $data = $_POST;
                $data['user_create'] = $_SESSION['user-auth']['id'];
                //var_dump($data);die;
                $url = ROOT_PATH."index.php/creationCompte";
                $add = App::file_post_contents($url, $data);
                if($add){
                    header('Location: index.php?p=dashboard');
                }
            }
            include_once('../app/views/view_compteEnt.php');
        } elseif($p == "compteClient"){//(Compte | Profil) Client
            if(!empty($_POST)){//Renseignez les informations du client
                $data = $_POST;
                $data['user_create'] = $_SESSION['user-auth']['id'];
                $url = ROOT_PATH."index.php/creationCclient";
                $add = App::file_post_contents($url, $data);
                if($add){
                    header('Location: index.php?p=myCompte');
                }
            }
            include_once('../app/views/view_compteClient.php');
        } elseif($p == "myCompte"){//View myCompte Client
            include_once('../app/views/view_dashMyCompte.php');
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
                    if(isset($_POST['id_pays'])){//Suppression (Logique) Pays
                        $id = $_POST['id_pays'];
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
                        //die(var_dump($add));
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
            if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {//Modif TypeEntreprise
                if (!empty($_POST)) {
                    $data = $_POST;
                    $url = ROOT_PATH."index.php/update/typeEnt/".$_GET['modif'];
                    $update = App::file_post_contents($url, $data);
                    if($update){
                        header('Location: index.php?p=lstTypeEnt');
                    }
                }
            } else {
                if(!empty($_POST)){
                    if(isset($_POST['id_type_entreprise'])){//Suppression (Logique) Type Entreprise
                        $id = $_POST['id_type_entreprise'];
                        $url = ROOT_PATH."index.php/delete/typeEnt/".$id;
                        $delete = file_get_contents($url);
                        if($delete){
                            $_SESSION['message'] = "Opération reussi !!";
                        } else {
                            $_SESSION['message'] = "Echec de l'opération!!";
                        }
                    } else {//Ajout Pays
                        $data = $_POST;
                        $data['user_create'] = $_SESSION['user-auth']['id'];
                        $url = ROOT_PATH."index.php/addTypeEnt";
                        $add = App::file_post_contents($url, $data);
                        //die(var_dump($add));
                        if($add){
                            header('Location: index.php?p=lstTypeEnt');
                        }
                    }
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
        } elseif($p == "paiement"){//View Page de Paiement
            $id = $_SESSION['user-auth']['entreprise'];
            include_once('../app/views/view_paiement.php');
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
        } elseif($p == "lstClt"){//View Liste Client 
            if(!empty($_POST)){//Suppression Clients
                $id = $_POST['id_client'];
                $url = ROOT_PATH."index.php/delete/client/".$id;
                $delete = file_get_contents($url);
                if($delete){
                    $_SESSION['message'] = "Opération reussi !!";
                } else {
                    $_SESSION['message'] = "Echec de l'opération!!";
                }
            }
            include_once('../app/views/view_lstClient.php');
        } elseif($p == "api_cle"){//View Génération api cle
            $apikey= "localhost/slim3/paieweb/index.php?p=paiement&clt=";
            if(!empty($_POST)) {
                // if(isset($_POST['id_action'])){//Suppression (Logique) API
                //     $id = $_POST['id_action'];
                //     $url = ROOT_PATH."index.php/delete/menu/".$id;
                //     $delete = file_get_contents($url);
                //     if($delete){
                //         $_SESSION['message'] = "Opération reussi !!";
                //     } else {
                //         $_SESSION['message'] = "Echec de l'opération!!";
                //     }
                // } else {//Ajout API
                    $data = $_POST;
                    $apikey.=$data['id_entreprise'];
                    $data['apikey'] = $apikey;
                    //var_dump($data);die;
                    //$data['user_create'] = $_SESSION['user-auth']['id'];
                    $url = ROOT_PATH."index.php/addApi";
                    $add = App::file_post_contents($url, $data);
                    //var_dump($add);die;
                    if($add){
                        header('Location: index.php?p=api_cle');
                    }
                //}
            }
            include_once('../app/views/view_apiKey.php');
        }  elseif($p == "role"){
            // if(!empty($_POST)){//Suppression TypeUser
            //     $id = $_POST['id_typeuser'];
            //     $url = ROOT_PATH."index.php/deleteTypeUser/".$id;
            //     $delete = file_get_contents($url);
            //     if($delete){
            //         $_SESSION['message'] = "Opération reussi !!";
            //     } else {
            //         $_SESSION['message'] = "Echec de l'opération!!";
            //     }
            // }
            include_once('../app/views/view_role.php');
        } elseif($p == "module"){
            if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {//Modif Module
                if (!empty($_POST)) {
                    $data = $_POST;
                    $url = ROOT_PATH."index.php/update/module/".$_GET['modif'];
                    $update = App::file_post_contents($url, $data);
                    if($update){
                        header('Location: index.php?p=module');
                    }
                }
            } else {
                if(!empty($_POST)){
                    $id = $_POST['id_groupe'];
                    if(isset($id)){//Suppression (Logique) Module
                        $url = ROOT_PATH."index.php/delete/module/".$id;
                        $delete = file_get_contents($url);
                        if($delete){
                            $_SESSION['message'] = "Opération reussi !!";
                        } else {
                            $_SESSION['message'] = "Echec de l'opération!!";
                        }
                    } else {//Ajout Module
                        $data = $_POST;
                        //$data['user_create'] = $_SESSION['user-auth']['id'];
                        $url = ROOT_PATH."index.php/addModule";
                        $add = App::file_post_contents($url, $data);
                        if($add){
                            header('Location: index.php?p=module');
                        }
                    }
                }
            }
            include_once('../app/views/view_module.php');
        } elseif($p == "menu"){
            if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {//Modif Menu
                if (!empty($_POST)) {
                    $data = $_POST;
                    $url = ROOT_PATH."index.php/update/menu/".$_GET['modif'];
                    $update = App::file_post_contents($url, $data);
                    if($update){
                        header('Location: index.php?p=menu');
                    }
                }
            } elseif(isset($_POST['menu']) && isset($_POST['profil'])){
                    $data = $_POST;
                    $url = ROOT_PATH."index.php/addMenuToProfil";
                    $add = App::file_post_contents($url, $data);
                    if($add){
                        header('Location: index.php?p=menu&role='.$role);
                    }
            } elseif(!empty($_POST)) {
                if(isset($_POST['id_action'])){//Suppression (Logique) Menu
                    $id = $_POST['id_action'];
                    $url = ROOT_PATH."index.php/delete/menu/".$id;
                    $delete = file_get_contents($url);
                    if($delete){
                        $_SESSION['message'] = "Opération reussi !!";
                    } else {
                        $_SESSION['message'] = "Echec de l'opération!!";
                    }
                } else {//Ajout Menu
                    $data = $_POST;
                    //$data['user_create'] = $_SESSION['user-auth']['id'];
                    $url = ROOT_PATH."index.php/addMenu";
                    $add = App::file_post_contents($url, $data);
                    if($add){
                        header('Location: index.php?p=menu');
                    }
                }
            }
            include_once('../app/views/view_menu.php');
        } elseif($p == "api"){//View API
            if(!empty($_POST)){//Bloquer
                $id = $_POST['id_cle'];
                $url = ROOT_PATH."index.php/bloquer/api/".$id;
                $bloquer = file_get_contents($url);
                //var_dump($delete);
                //die();
                if($bloquer){
                    $_SESSION['message'] = "Opération reussi !!";
                } else {
                    $_SESSION['message'] = "Echec de l'opération!!";
                }
            }
        include_once('../app/views/view_api.php');
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
            //le profil du user
            $id_profil = $user['0']['type_user']; 
            //********1.récupération de la liste des actions autorisées du bloc Administration***********************************
            $sql = "SELECT  g.id_groupe,icon_groupe, icon_action, libelle_groupe, p.id_action, libelle_action, url_action
                FROM action a, profil_has_action p, groupe_action g
                WHERE a.id_action = p.id_action and a.id_groupe=g.id_groupe
                and id_profil=? and bloc_menu='administration' and a.statut=1
                order by libelle_groupe asc, ordre_affichage_action asc";
            $result_administration = $pdo->prepare($sql, [$id_profil]);
            //initialisation de la variable de session pour administration
            $_SESSION['bloc_administration']= array();
            $i=0;
            foreach($result_administration as $row_administration){
                $_SESSION['bloc_administration'][$i] = array('id_groupe' => $row_administration['id_groupe'],
                                                     'libelle_groupe' => $row_administration['libelle_groupe'],
                                                     'icon_groupe' => $row_administration['icon_groupe'],
                                                     'icon_action' => $row_administration['icon_action'],
                                                     'id_action' => $row_administration['id_action'],
                                                     'libelle_action' => $row_administration['libelle_action'],
                                                     'url_action' => $row_administration['url_action']
                );
                $i++;
            }//fin foreach
            //**********2.récupération de la liste des actions autorisées du bloc configuration*********************
            $sql = "SELECT  g.id_groupe,icon_groupe, icon_action, libelle_groupe, p.id_action, libelle_action, url_action
                FROM action a, profil_has_action p, groupe_action g
                WHERE a.id_action = p.id_action and a.id_groupe=g.id_groupe
                and id_profil=$id_profil and bloc_menu='config' and a.statut=1
                order by ordre_affichage_groupe asc, g.id_groupe,  ordre_affichage_action asc";
            $result_config = $pdo->query($sql);
            //initialisation de la variable de session pour le bloc config
            $_SESSION['bloc_config']= array();
            $i=0;
            foreach($result_config as $row_config){
                $_SESSION['bloc_config'][$i] = array('id_groupe' => $row_config['id_groupe'],
                                                     'libelle_groupe' => $row_config['libelle_groupe'],
                                                     'icon_groupe' => $row_config['icon_groupe'],
                                                     'icon_action' => $row_config['icon_action'],
                                                     'id_action' => $row_config['id_action'],
                                                     'libelle_action' => $row_config['libelle_action'],
                                                     'url_action' => $row_config['url_action']
                                                );
                $i++;
            }//fin foreach
            //**********3.récupération de la liste des actions autorisées du bloc compte*********************
            $sql = "SELECT  g.id_groupe,icon_groupe, icon_action, libelle_groupe, p.id_action, libelle_action, url_action
                FROM action a, profil_has_action p, groupe_action g
                WHERE a.id_action = p.id_action and a.id_groupe=g.id_groupe
                and id_profil=$id_profil and bloc_menu='compte' and a.statut=1
                order by ordre_affichage_groupe asc, g.id_groupe,  ordre_affichage_action asc";
            $result_compte = $pdo->query($sql);
            //initialisation de la variable de session pour le bloc compte
            $_SESSION['bloc_compte']= array();
            $i=0;
            foreach($result_compte as $row_compte){
                $_SESSION['bloc_compte'][$i] = array('id_groupe' => $row_compte['id_groupe'],
                                                     'libelle_groupe' => $row_compte['libelle_groupe'],
                                                     'icon_groupe' => $row_compte['icon_groupe'],
                                                      'icon_action' => $row_compte['icon_action'],
                                                     'id_action' => $row_compte['id_action'],
                                                     'libelle_action' => $row_compte['libelle_action'],
                                                     'url_action' => $row_compte['url_action']
                );
                $i++;
            }//fin foreach
            //**********4.récupération de la liste des actions autorisées du bloc parametre*********************
            $sql = "SELECT  g.id_groupe,icon_groupe, icon_action, libelle_groupe, p.id_action, libelle_action, url_action
                FROM action a, profil_has_action p, groupe_action g
                WHERE a.id_action = p.id_action and a.id_groupe=g.id_groupe
                and id_profil=$id_profil and bloc_menu='parametre' and a.statut=1
                order by ordre_affichage_groupe asc, g.id_groupe,  ordre_affichage_action asc";
            $result_parametre = $pdo->query($sql, [$id_profil]);
            //initialisation de la variable de session pour le bloc parametre
            $_SESSION['bloc_parametre']= array();
            $i=0;
            foreach($result_parametre as $row_parametre){
                $_SESSION['bloc_parametre'][$i] = array('id_groupe' => $row_parametre['id_groupe'],
                    'libelle_groupe' => $row_parametre['libelle_groupe'],
                    'icon_groupe' => $row_parametre['icon_groupe'],
                    'icon_action' => $row_parametre['icon_action'],
                    'id_action' => $row_parametre['id_action'],
                    'libelle_action' => $row_parametre['libelle_action'],
                    'url_action' => $row_parametre['url_action']
                );
                $i++;
            }//fin foreach
            //header('Location: index.php?p=dashboard');
            if($_SESSION['user-auth']['typeUser']==="Administrateur"){//Verification si c'est un Administrateur
                header('Location: index.php?p=dashBoard');
            } elseif($_SESSION['user-auth']['typeUser']==="Client"){//Verification si c'est un client
                $id = $_SESSION['user-auth']['id'];
                $compteClient = $pdo->prepare("SELECT * FROM client WHERE statut=1 AND user_create=?", [$id]);
                $_SESSION['user-auth']['client'] = $compteClient['0']['id_client'];//ID Client
                if(empty($compteClient['0']['id_client'])){//Vérification (Si l'utilisateur n'a pas de compte client)
                    header('Location: index.php?p=compteClient');
                } else {
                    header('Location: index.php?p=myCompte');
                }   
            } else {
                $id = $_SESSION['user-auth']['id'];
                $compte = $pdo->prepare("SELECT * FROM entreprise WHERE statut=1 AND user_create=?", [$id]);
                $_SESSION['user-auth']['entreprise'] = $compte['0']['id_entreprise'];//ID Entreprise
                //var_dump($compte['0']['id_entreprise']);die();
                if(empty($compte['0']['id_entreprise'])){//Vérification (Si l'utilisateur n'a pas de compte entreprise)
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
        //$data['type_user'] = 2; 
        $url = ROOT_PATH."index.php/signUpUser";
        $signUp = App::file_post_contents($url, $data);
        if($signUp){
            header('Location: index.php?p=login');
        }
    }
    require('../app/views/view_signUp.php');
}