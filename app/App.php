<?php
use Core\Config;
use Core\Database\MysqlDatabase;
/**
 * Design Pattern Factory
 * Cette classe me permettra de retenir les données des variables
 * Elle est aussi le corps de notre application
 */
class App
{
    public $title = "IslamNiger";
    private $db_instance;
    private static $instance;

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new App();
        }
        return self::$instance;
    }

    /**
     * Load function
     * Il démarre la session,
     * Il require les autoloaders dont on a besoin,
     * Puis il instancie leur registre
     * @return void
     */
    public static function load(){
        //session_start();
        //define('ROOT', dirname(__DIR__));
        require '../app/Autoloader.php';
        App\Autoloader::register();
        require 'core/Autoloader.php';
        Core\Autoloader::register();
    }

    /**
     * Design Pattern Factory,
     * La fonction permet d'instancier la table voulu,
     * @param string $name le nom de la classe a instancier
     * @return void
     */
    public function getTable($name){
        $class_name = '\\App\\Table\\' . ucfirst($name) . 'Table';
        return new $class_name($this->getDb());
    }
    /**
     * Design Pattern Factory,
     * Ce factory pour la connexion au bdd,
     * Il genere une seule instance,
     * il fait appel à la fonction getInstance() de la classe Config
     * pour recuperer le db_name, le db_pass, db_user, db_host,
     * et instancie la classe Database (construct) pour se connecter,
     * @return void la connexion au bdd
     */
    public function getDb(){
        $config = Config::getInstance('config/config.php');
        if(is_null($this->db_instance)){
            $this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }
        return $this->db_instance;
    }

    public static function file_post_contents($url, $data){
        $postdata = http_build_query($data);
        $opts = array(
            'http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        return file_get_contents($url, false, $context);
    }
}