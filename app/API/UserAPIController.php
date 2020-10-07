<?php
namespace App\API\Controller;

class UserAPIController extends APIControllers {

    public function getUsers(){
        $this->getPDO()->query('SELECT * FROM users');
    }

    public function getUser($id){
        $this->getPDO()->query("SELECT * FROM users WHERE id='$id'");
    }
}