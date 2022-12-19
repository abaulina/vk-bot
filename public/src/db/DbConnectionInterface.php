<?php
namespace App\db;

interface DbConnectionInterface
{
    public function getConnection();
}