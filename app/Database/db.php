<?php
namespace App\Database;

use PDO;

class db
{
    private $pdo;

    /**
     * Fonction Connect
     * Elle nous permet de se connecter et d'instancier le pdo tout en vérifiant s'il existe déja.
     * @return pdo la connection
     */
    public function connect()
    {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "2i_soft_paie";
        if($this->pdo == null){
            //connect database using php pdo wrapper 
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo = $pdo;
        }
    
        return $this->pdo;
    }

    /**
     * Fonction Prepare
     * @param String sql la requete
     * @param String attributes
     * 
     */
    public function prepare($sql, $attributes = [], $one = false){
        //$req = $this->getPDO()->prepare($statement);
        //$res = $req->execute($attributes);
        $req = $this->connect()->prepare($sql);
        if($attributes){
            $result = $req->execute($attributes);
        } else {
            $result = $req->execute();
        }
        if(
            strpos($sql, 'UPDATE') === 0 ||
            strpos($sql, 'INSERT') === 0 ||
            strpos($sql, 'DELETE') === 0
        )
        {
            return $result;
        }
        if($one){
            $datas = $req->fetch();
        }
        else{
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    /**
     * Fonction Query
     * @param String sql la requete
     * @param Boolean one true/false
     * @return le résultat
     */
    public function query($sql, $objet = false, $one = false){
        $req = $this->connect()->query($sql);
        if($objet === true){
            $req->setFetchMode(PDO::FETCH_OBJ);
        }
        if($one){
            $result = $req->fetch();
        } else {
            $result = $req->fetchAll();
        }
        return $result;
    }

    /**
     * Fonction Insertion
     * @param String sql la requete
     * @param Array data les données
     * @return l'execution
     */
    public function insert($sql, $data = []){
        //if($params){
            var_dump($data);
            $req = $this->connect()->prepare($sql);
            $result = $req->execute($data);
            return $result;
            //echo '{"notice": {"text": "User has been just added now"}}';
        //}
    }

    public function lastId(){
        return $this->connect()->lastInsertId();
    }

    public function login($sql, $attributes){
        $req = $this->prepare($sql, $attributes);
        return $req;
    }

    public function logged(){
        return isset($_SESSION['auth']);
    }
    /**
     * Deconnexion Fonction
     * @return Session destroy
     */
    public function deconnexion(){
        return session_destroy();
    }
}
