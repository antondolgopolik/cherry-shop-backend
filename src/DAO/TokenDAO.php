<?php

declare(strict_types=1);

namespace WebTech\CherryShop\DAO;

use PDO;
use WebTech\CherryShop\DB\Database;

class TokenDAO
{
    private static TokenDAO $instance;
    private PDO $connection;

    public static function getInstance(): TokenDAO
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

    public function create(int $user_id, string $token): void
    {
        // Подготовка запроса
        $sql = 'INSERT INTO tokens (user_id, token) VALUES (?, ?)';
        $statement = $this->connection->prepare($sql);
        // Выполнение запроса
        $statement->execute(array($user_id, $token));
    }

    public function lives(int $user_id, string $token): bool
    {
        // Подготовка запроса
        $sql = 'SELECT * FROM tokens WHERE (user_id = ?) and (token = ?) and (age(current_timestamp, generation_date) < ttl)';
        $statement = $this->connection->prepare($sql);
        // Выполнение запроса
        $statement->execute(array($user_id, $token));
        $result = $statement->fetchAll();

        return !empty($result);
    }
}