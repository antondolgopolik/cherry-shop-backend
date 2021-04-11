<?php

namespace WebTech\CherryShop\controllers\login;

use WebTech\CherryShop\dao\UserDAO;
use WebTech\CherryShop\dao\TokenDAO;

class LoginController
{
    function isAuthorized(): void
    {
        $loginIsSet = isset($_COOKIE['api-cherry-shop-login']);
        $tokenIsSet = isset($_COOKIE['api-cherry-shop-token']);
        // Проверка cookie
        if ($loginIsSet && $tokenIsSet) {
            $login = $_COOKIE['api-cherry-shop-login'];
            $userId = UserDAO::getInstance()->id($login);
            $token = $_COOKIE['api-cherry-shop-token'];
            // Проверка годен ли токен
            if (TokenDAO::getInstance()->lives($userId, $token)) {
                echo json_encode(array('isAuthorized' => true));
                return;
            }
        }
        echo json_encode(array('isAuthorized' => false));
    }

    function logIn($login, $password): void
    {
        // Проверка существует ли пользователь с данными логином и паролем
        if (!UserDAO::getInstance()->exists($login, hash('sha256', $password))) {
            http_response_code(401);
        } else {
            $userId = UserDAO::getInstance()->id($login);
            $token = hash('sha256', $login . $password);
            // Запоминаем в cookies
            $time = time() + 7 * 24 * 60 * 60;
            setcookie('api-cherry-shop-login', $login, $time, '/', 'cherry-shop.com');
            setcookie('api-cherry-shop-token', $token, $time, '/', 'cherry-shop.com');
            // Заносим новый токен в БД
            TokenDAO::getInstance()->create($userId, $token);
            echo '{}';
        }
    }
}