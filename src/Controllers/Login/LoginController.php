<?php

namespace WebTech\CherryShop\Controllers\Login;

use WebTech\CherryShop\DAO\UserDAO;
use WebTech\CherryShop\DAO\TokenDAO;

class LoginController
{
    function isAuthorized(): void
    {
        global $configs;
        // Проверка наличия cookie
        $loginIsSet = isset($_COOKIE[$configs['cookie-login']]);
        $tokenIsSet = isset($_COOKIE[$configs['cookie-token']]);
        // Если есть cookie
        if ($loginIsSet && $tokenIsSet) {
            $login = $_COOKIE[$configs['cookie-login']];
            $userId = UserDAO::getInstance()->id($login);
            $token = $_COOKIE[$configs['cookie-token']];
            // Проверка годен ли токен
            if (TokenDAO::getInstance()->lives($userId, $token)) {
                return;
            }
        }
        // Пользователь неавторизован
        http_response_code(401);
    }

    function logIn(string $login, string $password): void
    {
        global $configs;
        // Если существует пользователь с данными логином и паролем
        if (!UserDAO::getInstance()->exists($login, hash('sha256', $password))) {
            http_response_code(401);
        } else {
            $userId = UserDAO::getInstance()->id($login);
            $token = hash('sha256', $login . $password);
            // Запоминаем в cookies
            $time = time() + 7 * 24 * 60 * 60;
            setcookie($configs['cookie-login'], $login, $time, '/', 'cherry-shop.com');
            setcookie($configs['cookie-token'], $token, $time, '/', 'cherry-shop.com');
            // Заносим новый токен в БД
            TokenDAO::getInstance()->create($userId, $token);
        }
    }
}