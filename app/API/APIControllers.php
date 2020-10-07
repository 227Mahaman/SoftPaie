<?php
namespace App\API\Controller;

use App\Database\db;

class APIControllers {

    public function getPDO()
    {
        return new db();
    }
}