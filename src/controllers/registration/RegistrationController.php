<?php


namespace WebTech\CherryShop\controllers\registration;

use PDOException;
use WebTech\CherryShop\dao\UserDAO;

class RegistrationController
{
    function signUp($login, $password): void
    {
        try {
            UserDAO::getInstance()->create($login, hash('sha256', $password));
            echo '{}';
        } catch (PDOException $e) {
            http_response_code(409);
        }
    }
}