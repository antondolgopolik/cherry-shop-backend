<?php

namespace WebTech\CherryShop\Controllers\Products;

use PDOException;
use WebTech\CherryShop\DAO\ProductDAO;

class ProductsController
{
    function getAll(): void
    {
        $products = ProductDAO::getInstance()->readAll();
        echo json_encode($products);
    }

    function get(int $id): void
    {
        try {
            $product = ProductDAO::getInstance()->read($id);
            echo json_encode($product);
        } catch (PDOException $e) {
            http_response_code(401);
        }
    }
}