<?php
require_once(MODEL_PATH . 'Connection.php');
abstract class DAO 
{
  private $_erreur;

  public function __construct()
  {
    $this->_erreur = null;
  }

  protected function beginTransaction()
  {
   Connexion::getInstance()->getBdd()->beginTransaction(); 
  }

  protected function endTransaction()
  {
    if(is_null($this->_erreur))
      Connexion::getInstance()->getBdd()->commit();
  }

  private function _query($sql, $args = null)
  {
    if ($args == null) 
    {
	$pdos = Connexion::getInstance()->getBdd()->query($sql);
    }
    else 
    {
	$pdos = Connexion::getInstance()->getBdd()->prepare($sql);
	$pdos->execute($args);
    }

    return $pdos;
  }

  protected function queryRow($sql, $args = null)
  {
	try
	{
		$pdos = $this->_query($sql, $args);
		$res = $pdos->fetch();
                $pdos->closeCursor();
	}
	catch(PDOException $e)
	{
	    $this->_erreur = 'query';
	    $res = false;
	} 
    return $res;
  }

  protected function queryBdd($sql, $args = null)
  {
    $res = true;
    try
    {
		$pdos = $this->_query($sql, $args);
        $pdos->closeCursor();	
    }
    catch(PDOException $e)
    {
      $this->_erreur = 'query';
      $res = false;
    }
    return $res;
  }

  protected function queryAll($sql, $args = null)
  {
 	try
	{
		$pdos = $this->_query($sql, $args);
		$res = $pdos->fetchAll();
                $pdos->closeCursor();
	}
	catch(PDOException $e)
	{
	    $this->_erreur = 'query';
	    $res = false;
	} 
    return $res;
  }
}
