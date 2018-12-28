<?php

class Connexion {
    private $_bdd = null;
    private static $_instance = null;

    private function __construct () {
        $this->_bdd = new PDO('mysql:host='.DB_SERVER .'; dbname='. DB_NAME .'; charset=utf8', DB_USER_NAME, DB_USER_PSWD);
        $this->_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if(is_null(self::$_instance))
            self::$_instance = new Connexion();
        return self::$_instance;
    }

    public function getBdd() {
        return $this->_bdd;
    }
}