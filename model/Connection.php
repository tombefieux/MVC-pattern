<?php

/**
 * Class Connection
 * To get a connection instance of the database.
 */
class Connection {
    private $_DB = null;
    private static $_instance = null;

    /**
     * Connection constructor.
     */
    private function __construct () {
        $this->_DB = new PDO('mysql:host='.DB_SERVER .'; dbname='. DB_NAME .'; charset=utf8', DB_USER_NAME, DB_USER_PSWD);
        $this->_DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Get the connection instance.
     * @return Connection: the instance.
     */
    public static function getInstance() {
        if(is_null(self::$_instance))
            self::$_instance = new Connection();
        return self::$_instance;
    }

    /**
     * Get the database.
     * @return PDO: the database.
     */
    public function getDB() {
        return $this->_DB;
    }
}