<?php
namespace Project\Controller;
use Project\Model\Furniture;

class FurnitureController
{
    public function store($data)
    {
        $furniture = new Furniture($data['sku'], $data['name'], $data['price'], $data['dimensions']);
        return $furniture->save();
    }
}