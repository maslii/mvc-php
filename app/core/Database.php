<?php

class Database
{
    private $database;

    public function __construct(
        string $db_server,
        string $db_host,
        string $db_name,
        string $db_charset,
        string $db_user,
        string $db_password,
        array $options
    )
    {
        try {
            $this->database = new PDO(
                $db_server . ':host=' .
                $db_host . ';dbname=' .
                $db_name . ';charset=' .
                $db_charset,
                $db_user,
                $db_password,
                $options
            );
        } catch (PDOException $e) {
            exit('Database error');
        }
    }

    public function getConnection(): PDO
    {
        return $this->database;
    }
}