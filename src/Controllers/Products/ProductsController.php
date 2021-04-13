<?php

namespace WebTech\CherryShop\Controllers\Products;

use WebTech\CherryShop\DAO\ProductDAO;

class ProductsController
{
    function getAll(): void
    {
        $products = ProductDAO::getInstance()->readAll();
        echo json_encode($products);
    }
}