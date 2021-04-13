<?php

use WebTech\CherryShop\Controllers\Home\HomeController;
use WebTech\CherryShop\Controllers\Login\LoginController;
use WebTech\CherryShop\Controllers\Products\ProductsController;
use WebTech\CherryShop\Controllers\Registration\RegistrationController;

require_once __DIR__ . "/../vendor/autoload.php";

$url = $_SERVER['DOCUMENT_URI'];
$urlParts = explode('/', $url);

switch ($urlParts[1]) {
    // Определение контроллера
    case 'login':
        login();
        break;
    case 'registration':
        registration();
        break;
    case 'home':
        home();
        break;
    case 'products':
        products();
        break;
    default :
        error();
}

function login()
{
    global $urlParts;
    $controller = new LoginController();
    // Определение функции
    switch ($urlParts[2]) {
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

function registration()
{
    global $urlParts;
    $controller = new RegistrationController();
    // Определение функции
    switch ($urlParts[2]) {
        case 'signUp.php':
            $controller->signUp($_POST['login'], $_POST['password']);
            break;
        default:
            error();
    }
}

function home()
{
    global $urlParts;
    $controller = new HomeController();
    // Определение функции
    switch ($urlParts[2]) {
        default:
            error();
    }
}

function products()
{
    global $urlParts;
    $controller = new ProductsController();
    // Определение функции
    switch ($urlParts[2]) {
        case 'getAll.php':
            $controller->getAll();
            break;
        default:
            error();
    }
}

function error()
{
    echo 'Error';
}