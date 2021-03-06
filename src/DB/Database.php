<?php

namespace WebTech\CherryShop\DB;

use PDO;

class Database
{
    private static Database $instance;
    private string $host;
    private string $dbname;
    private string $user;
    private string $password;

    public static function getInstance(): Database
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        global $secrets;
        $this->host = $secrets['db-host'];
        $this->dbname = $secrets['db-name'];
        $this->user = $secrets['db-user'];
        $this->password = $secrets['db-password'];
    }

    private function __clone()
    {
        trigger_error('Class could not be cloned', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error('Class could not be deserialized', E_USER_ERROR);
    }

    public function getConnection(): PDO
    {
        $connection = new PDO("pgsql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}