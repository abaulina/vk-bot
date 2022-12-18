<?php

namespace App\test;
use App\db\DbConnectionInterface;

class TestDbConnector implements DbConnectionInterface
{
    private string $connectionString;

    public function __construct()
    {
        $ini = parse_ini_file('testDbCredentials.ini');
        $this->connectionString = "host={$ini['host']} port={$ini['port']} dbname={$ini['dbname']} user={$ini['user']} password={$ini['password']}";
    }

    public function getConnection()
    {
        $connection = pg_connect($this->connectionString);

        if (!$connection) {
            echo "Unable to connect.";
            die();
        }

        return $connection;
    }

    public function deleteAllStudents()
    {
        pg_delete($this->getConnection(), 'Student', []);
    }

    public function addGroup($id,$name)
    {
        pg_query_params($this->getConnection(), 'INSERT INTO "group" VALUES ($1, $2);', array($id, $name));
    }

    public function deleteGroup($id)
    {
        pg_query_params($this->getConnection(), 'DELETE FROM "group" WHERE id = $1;', array($id));
    }
}
