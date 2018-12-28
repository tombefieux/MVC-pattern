<?php

require_once (MODEL_PATH . "DAO.php");
require_once (ENTITY_PATH . "Entity.php");

/**
 * Class EntityDAO
 * To manage the entities with the database.
 */
class EntityDAO extends DAO
{
    /**
     * Get all your entities.
     * @return array: an array of your entities in the database.
     */
    public function getEntities() {
        $entities = array();

        $result = $this->queryAll("SELECT * FROM entity");
        foreach ($result as $entity)
            $entities[] = new Entity(); // add in the constructor the values get by the entity array

        return $entities;
    }

    /**
     * Get an entity with its id.
     * @param $id: the id of the entity.
     * @return Entity: the entity or null if doesn't exist.
     */
    public function getEntity($id) {
        $entity = null;

        $result = $this->queryRow("SELECT * FROM entity WHERE id = ?", array($id));
        if(!empty($result))
            $entity = new Entity(); // add in the constructor the values get by the result array

        return $entity;
    }

    /**
     * Delete an entity with its id (you can also take in parameter an entity object
     * and get its id with a getter).
     * @param $id: the id of the entity.
     * @return bool: if the entity have been deleted.
     */
    public function deleteEntity($id) {
        return $this->queryBdd("DELETE FROM entity WHERE id = ?", array($id));
    }
}