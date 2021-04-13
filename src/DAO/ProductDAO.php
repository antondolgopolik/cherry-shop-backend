<?php

declare(strict_types=1);

namespace WebTech\CherryShop\DAO;

use PDO;
use WebTech\CherryShop\DB\Database;

class ProductDAO
{
    private static ProductDAO $instance;
    private PDO $connection;

    public static function getInstance(): ProductDAO
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    private function __clone()
    {
        trigger_error('Class could not be cloned', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error('Class could not be deserialized', E_USER_ERROR);
    }

    public function readAll(): array
    {
        // Подготовка запроса
        $sql = 'SELECT * FROM products';
        $statement = $this->connection->prepare($sql);
        // Выполнение запроса
        $statement->execute();

        return $statement->fetchAll();
    }
}