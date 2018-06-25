<?php

class Controller
{
    protected $view;
    protected $cart;
    protected $database;
    protected $model;
    
    public function __construct()
    {
        $this->database = new Database(
            DATABASE_SERVER,
            DATABASE_HOST,
            DATABASE_NAME,
            DATABASE_CHARSET,
            DATABASE_USER_NAME,
            DATABASE_USER_PASSWORD,
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            ]
        );
        
        $this->view = new View();
        $this->cart = new Cart(
            new Cookie(
                COOKIE_EXPIRE,
                COOKIE_PATH,
                COOKIE_DOMAIN,
                COOKIE_SECURE,
                COOKIE_HTTPONLY
            )
        );
    }
}