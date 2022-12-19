<?php
namespace App\db;

class DbConnector implements DbConnectionInterface
{
    private string $connectionString;

    public function __construct()
    {
        $ini = parse_ini_file('dbCredentials.ini');
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
}