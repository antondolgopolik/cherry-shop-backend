<?php

namespace WebTech\CherryShop\models;

class User
{
    private string $surname;
    private string $name;
    private string $login;
    private string $password;
    private string $type;

    public function __construct($surname, $name, $login, $password, $type)
    {
        $this->surname = $surname;
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        $this->type = $type;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getType(): string
    {
        return $this->type;
    }
}