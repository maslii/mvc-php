<?php

// Модель для роботи з товарами.

class ProductModel
{
    private $databaseConnection;

    public function __construct(PDO $connection)
    {
        $this->databaseConnection = $connection;
    }

    public function getAll(): array
    {
        $statement = $this->databaseConnection->query('SELECT * FROM catalog');

        return $statement->fetchAll();
    }

    public function get(int $id)
    {
        $statement = $this->databaseConnection->prepare('SELECT * FROM catalog WHERE id=:id');
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->fetch();
    }
}