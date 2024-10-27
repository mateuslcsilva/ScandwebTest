<?php
namespace Project\Controller;
use Project\Connection\DatabaseConnection;

class BookController
{
    private DatabaseConnection $db;

    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->db = $db;
    }

    public function create($product)
    {
        $data = [
            'sku' => $product->getSku(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'weight' => $product->getWeight(),
        ];
        $this->db->insert('products', $data);
    }
}