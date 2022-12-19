<?php

namespace App\managers;
use App\db\DbConnectionInterface;

class GroupManager
{
    private DbConnectionInterface $dbConnector;

    public function __construct(DbConnectionInterface $db)
    {
        $this->dbConnector = $db;
    }

    public function getAllGroupNames(): bool|array
    {
        $result = pg_query(
            $this->dbConnector->getConnection(),'SELECT Name FROM "group";');

        if (!$result) {
            return false;
        }

        return pg_fetch_all($result);
    }

    public function getGroupIdByName($groupName): object|bool
    {
        $result = pg_query_params(
            $this->dbConnector->getConnection(),'SELECT * FROM "group" WHERE Name = $1;', array($groupName));

        if (!$result) {
            return false;
        }

        $group = pg_fetch_object($result);
        return $group->id;
    }
}