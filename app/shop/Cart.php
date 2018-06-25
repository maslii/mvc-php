<?php

// Клас для роботи з корзиною.
//Містить масив товарів представлених класом Product та функції для маніпуляції корзиною.

class Cart
{
    private $products;
    private $cookie;
    
    public function getAll(): array
    {
        return $this->products;
    }
    
    public function countAll(): int
    {
        $count = 0;
        
        if (!$this->isEmpty()) {
            foreach ($this->products as $key => $value) {
                $count += $value->getCount();
            }
        }
        
        return $count;
    }
    
    public function priceAll()
    {
        $sum = 0;
        
        if (!$this->isEmpty()) {
            foreach ($this->products as $key => $value) {
                $sum += $value->getPrice() * $value->getCount();
            }
        }
        
        return $sum;
    }
    
    public function refresh(array $dbData): void
    {
        foreach ($this->products as $key => $value) {
            foreach ($dbData as $row) {
                if ($row->id === $value->getId()) {
                    if ($row->price !== $value->getPrice()) {
                        $value->setPrice($row->price);
                    }
                }
            }
        }
    
        $this->cookie->set('products', serialize($this->products));
    }
    
    public function __construct(Cookie $cookie)
    {
        $this->cookie = $cookie;
        
        if ($this->cookie->get('products') === null) {
            $this->products = [];
        } else {
            
            // єдиний (в даний момент) спосіб перевірити правильність десеріалізації
            
            $unserialized = @unserialize(
                $this->cookie->get('products'),
                [Product::class]
            );
            
            if ($unserialized !== false) {
                $this->products = $unserialized;
            } else {
                $this->products = [];
                $this->cookie->set('products', serialize($this->products));
            }
        }
    }
    
    public function add(int $id, int $price, int $count): void
    {
        $f = false;
        
        foreach ($this->products as $key => $value) {
            if ($id === $value->getId()) {
                $value->setCount($value->getCount() + $count);
                $f = true;
            }
        }
        
        if (!$f) {
            $this->products[] = new Product($id, $price, $count);
        }
        
        $this->cookie->set('products', serialize($this->products));
    }
    
    public function remove(int $id): void
    {
        foreach ($this->products as $key => $value) {
            if ($value->getId() === $id) {
                unset($this->products[$key]);
            }
        }
        
        $this->cookie->set('products', serialize($this->products));
    }
    
    public function clear(): void
    {
        $this->cookie->remove('products');
        $this->products = [];
    }
    
    public function isEmpty(): bool
    {
        return empty($this->products);
    }
}