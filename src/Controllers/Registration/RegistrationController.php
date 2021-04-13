<?php


namespace WebTech\CherryShop\Controllers\Registration;

use PDOException;
use WebTech\CherryShop\DAO\UserDAO;

class RegistrationController
{
    function signUp(string $login, string $password): void
    {
        try {
            UserDAO::getInstance()->create($login, hash('sha256', $password));
            echo '{}';
        } catch (PDOException $e) {
            http_response_code(409);
        }
    }
}