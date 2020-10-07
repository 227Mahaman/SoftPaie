<?php
namespace App\Controllers;

use App\Database\db;
use PDO;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Controller {

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getPDO()
    {
        return new db();
    }

    public function render(RequestInterface $request, ResponseInterface $response, $file, $params = [])
    {
        $this->container->view->render($response, $file, $params);
    }

    public function redirect($response, $name){
        return $response->withStatus(302)->withHeader('Location', $this->router->pathFor($name));
    }

    public function flash($message, $type = 'success'){
        if(!isset($_SESSION['flash'])){
            $_SESSION['flash'] = [];
        }
        return $_SESSION['flash'][$type] = $message;
    }

    public function __get($name){
        return $this->container->get($name);
    }

    public function logged(){
        return isset($_SESSION['auth']);
    }

    protected function forbidden(){
        header('HTTP/1.0 403 forbidden');
        die('Access interdit');
    }

}