<?php
// include the configuration file
require_once("include/conf.php");

// use a dao
require_once(MODEL_PATH . "EntityDAO.php");
$dao = new EntityDAO();

// delete an entity for example
/*
 *  $dao->deleteEntity($_GET["deleteId"]);
 */

// call the view
require_once(VIEW_PATH . "indexView.php");