<?php

use WebTech\CherryShop\Controllers\Home\HomeController;
use WebTech\CherryShop\Controllers\Login\LoginController;
use WebTech\CherryShop\Controllers\Products\ProductsController;
use WebTech\CherryShop\Controllers\Registration\RegistrationController;

require_once __DIR__ . "/../vendor/autoload.php";

// Подгрузка конфигураций
$configs = require_once __DIR__ . "/../config/configs.php";
$secrets = require_once __DIR__ . "/../config/secrets.php";
// Маршрутизация
route();

function route(): void
{
    // Разбиение пути на части
    $urlPath = $_SERVER['DOCUMENT_URI'];
    $urlPathParts = explode('/', $urlPath);
    // Определение контроллера
    switch ($urlPathParts[1]) {
        case 'login':
            login($urlPathParts);
            break;
        case 'registration':
            registration($urlPathParts);
            break;
        case 'home':
            home($urlPathParts);
            break;
        case 'products':
            products($urlPathParts);
            break;
        default :
            error();
    }
}

function login(array $urlPathParts): void
{
    $controller = new LoginController();
    // Определение функции
    switch ($urlPathParts[2]) {
        case 'isAuthorized.php':
            $controller->isAuthorized();
            break;
        case 'logIn.php':
            $controller->logIn($_GET['login'], $_GET['password']);
            break;
        default:
            error();
    }
}

function registration(array $urlPathParts): void
{
    $controller = new RegistrationController();
    // Определение функции
    switch ($urlPathParts[2]) {
        case 'signUp.php':
            $controller->signUp($_POST['login'], $_POST['password']);
            break;
        default:
            error();
    }
}

function home(array $urlPathParts): void
{
    $controller = new HomeController();
    // Определение функции
    switch ($urlPathParts[2]) {
        default:
            error();
    }
}

function products(array $urlPathParts): void
{
    $controller = new ProductsController();
    // Определение функции
    switch ($urlPathParts[2]) {
        case 'getAll.php':
            $controller->getAll();
            break;
        default:
            error();
    }
}

function error(): void
{
    echo 'Error';
}