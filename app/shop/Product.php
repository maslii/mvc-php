<?php

// Клас для зберігання інформації про товар.

class Product
{
    private $id;
    private $count;
    private $price;


    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function __construct(int $id, int $price, int $count)
    {
        $this->id = $id;
        $this->price = $price;
        $this->count = $count;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}