<?php
namespace Core\Database;

use Core\Interfaces\ConnectionInterface;
use Config\Database;

class Connection implements ConnectionInterface
{
    public function getConnection()
    {
        //$conn=new \PDO("sqlite:" . Database::DBPATH);
        $conn = new \mysqli(Database::SERVERNAME, Database::USERNAME, Database::PASSWORD, Database::DBNAME);
        if ($conn->connect_error) {
            die("Connection Faild: ". $conn->connect_error);
        }

        return $conn;
    }
}
