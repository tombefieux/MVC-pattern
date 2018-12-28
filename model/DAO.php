<?php
require_once(MODEL_PATH . 'Connection.php');

/**
 * Class DAO
 */
abstract class DAO
{
    private $_error;

    /**
     * DAO constructor.
     */
    public function __construct()
    {
        $this->_error = null;
    }

    /**
     * Start the transaction.
     */
    protected function beginTransaction()
    {
        Connection::getInstance()->getDB()->beginTransaction();
    }

    /**
     * End the transaction.
     */
    protected function endTransaction()
    {
        if(is_null($this->_error))
            Connection::getInstance()->getDB()->commit();
    }

    /**
     * Get PDOStatement for a query.
     * @param $sql: the query
     * @param null $params: the parameters
     * @return PDOStatement: the statement
     */
    private function _query($sql, $params = null)
    {
        if ($params == null)
            $pdos = Connection::getInstance()->getDB()->query($sql);

        else
        {
            $pdos = Connection::getInstance()->getDB()->prepare($sql);
            $pdos->execute($params);
        }

        return $pdos;
    }

    /**
     * Get a row of the database.
     * @param $sql: the querry.
     * @param null $params: the parameters.
     * @return bool|array: the array if it has worked, else false.
     */
    protected function queryRow($sql, $params = null)
    {
        try
        {
            $pdos = $this->_query($sql, $params);
            $res = $pdos->fetch();
            $pdos->closeCursor();
        }
        catch(PDOException $e)
        {
            $this->_error = 'query';
            $res = false;
        }
        return $res;
    }

    /**
     * Execute a simple query like insert, delete, update...
     * @param $sql: the querry.
     * @param null $params: the parameters.
     * @return bool: if it has worked
     */
    protected function queryBdd($sql, $params = null)
    {
        $res = true;
        try
        {
            $pdos = $this->_query($sql, $params);
            $pdos->closeCursor();
        }
        catch(PDOException $e)
        {
            $this->_error = 'query';
            $res = false;
        }
        return $res;
    }

    /**
     * Get several row of the database.
     * @param $sql: the querry.
     * @param null $params: the parameters.
     * @return array|bool: the array (2 dimensional) if it has worked, else false.
     */
    protected function queryAll($sql, $params = null)
    {
        try
        {
            $pdos = $this->_query($sql, $params);
            $res = $pdos->fetchAll();
            $pdos->closeCursor();
        }
        catch(PDOException $e)
        {
            $this->_error = 'query';
            $res = false;
        }
        return $res;
    }
}
