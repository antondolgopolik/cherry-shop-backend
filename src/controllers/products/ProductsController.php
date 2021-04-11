<?php

namespace WebTech\CherryShop\controllers\products;

use WebTech\CherryShop\dao\ProductDAO;

class ProductsController
{
    function getAll(): void
    {
        $products = ProductDAO::getInstance()->readAll();
        echo json_encode($products);
    }
}