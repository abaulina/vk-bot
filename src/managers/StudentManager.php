<?php

namespace App\managers;
use App\db\DbConnectionInterface;

class StudentManager
{
    private DbConnectionInterface $dbConnector;

    public function __construct(DbConnectionInterface $db)
    {
        $this->dbConnector = $db;
    }

    public function getStudentGroupId($studentId): object|bool
    {
        $result = pg_query_params($this->dbConnector->getConnection(), 'SELECT GroupId FROM Student WHERE Id = $1;', array($studentId));

        if (!$result) {
            return false;
        }

        $group = pg_fetch_object($result);

        if (!$group) {
            return false;
        }

        return $group->groupid;
    }

    public function addOrUpdateStudentGroup($studentId, $groupId): bool
    {
        $result = pg_query_params($this->dbConnector->getConnection(), 'INSERT INTO Student VALUES ($1, $2) ON CONFLICT (id) DO UPDATE SET GroupId = $2;', array($studentId, $groupId));

        if (!$result) {
            return false;
        }

        return true;
    }
}
