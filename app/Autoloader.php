<?php

namespace App;

class Autoloader
{
    /**
     * Elle appele la classe et la methode (function) autolaod
     * @return void
     */
    static function register(){
        spl_autoload_register(array(__CLASS__,'autoload'));
    }
    /**
     * Autoload function
     * @param string $class_name les classes qui se trouvent 
     * dans le dossier class
     * @return void
     */
    static function autoload($class){
        if(strpos($class, __NAMESPACE__ . '\\') === 0)
        {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            //DIR: représente le dossier parent
            require __DIR__ .'/' . $class . '.php';
        }
    }
}