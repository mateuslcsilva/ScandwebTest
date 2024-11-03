<?php
namespace Project\Controller;

use Project\Model\Book;

class BookController
{
    public function store($data)
    {
        $book = new Book($data['sku'], $data['name'], $data['price'], $data['weight']);
        return $book->save();
    }
}