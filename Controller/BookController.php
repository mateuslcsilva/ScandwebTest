<?php
namespace Project\Controller;
use Project\Connection\DatabaseConnection;
use Project\Model\Book;

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
        $retorno = $this->db->insert('products', $data);
        print_r($retorno);
    }

    public function getBooks($id = 0)
    {
        $retorno = $this->db->select("select * from products");
        $books = [];
        foreach ($retorno as $key => $value) {
            $book = new Book($value['sku'], $value['name'], $value['price'], $value['weight']);
            array_push($books, $book);
        }
        return $books;
    }
}