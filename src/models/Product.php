<?php

namespace WebTech\CherryShop\models;

class Product
{
    private string $name;
    private int $price;
    private string $image;
    private int $number;

    public function __construct(string $name, int $price, string $image, int $number)
    {
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->number = $number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getNumber(): int
    {
        return $this->number;
    }
}