<?php

declare(strict_types=1);

namespace WebTech\CherryShop\DAO;

use PDO;
use WebTech\CherryShop\DB\Database;

class UserDAO
{
    private static UserDAO $instance;
    private PDO $connection;

    public static function getInstance(): UserDAO
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

    public function create(string $login, string $password): void
    {
        // Подготовка запроса
        $sql = 'INSERT INTO users (user_login, user_password, user_type) VALUES (?, ?, 0)';
        $statement = $this->connection->prepare($sql);
        // Выполнение запроса
        $statement->execute([$login, $password]);
    }

    public function id(string $login): int
    {
        // Подготовка запроса
        $sql = 'SELECT id FROM users WHERE user_login = ?';
        $statement = $this->connection->prepare($sql);
        // Выполнение запроса
        $statement->execute([$login]);
        $result = $statement->fetch();

        return $result['id'];
    }

    public function exists(string $login, string $password): bool
    {
        // Подготовка запроса
        $sql = 'SELECT * FROM users WHERE user_login = ? and user_password = ?';
        $statement = $this->connection->prepare($sql);
        // Выполнение запроса
        $statement->execute([$login, $password]);
        $result = $statement->fetchAll();

        return !empty($result);
    }
}