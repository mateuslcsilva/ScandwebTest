<?php
namespace Project\Model;

use Project\Connection\DatabaseConnection;

class Furniture extends Product
{
    private string $dimensions;
    private DatabaseConnection $db;

    public function __construct(int $sku, string $name, float $price, string $dimensions)
	{
        parent::__construct($sku, $name, $price);
		$this->dimensions = $dimensions;

        $db = new DatabaseConnection;
        $this->db = $db;
	}

    public function getDimensions()
    {
        return $this->dimensions;
    }

    public function setDimensions(string $value)
    {
        $this->dimensions = $value;
    }

    public function save()
    {
        $data = [
            'sku' => parent::getSku(), 
            'name' => parent::getName(),
            'price' => parent::getPrice(),
            'dimensions' => $this->dimensions
        ];
        $skuExists = $this->db->selectCount('products', $data['sku']);
        if($skuExists > 0){
            $insert = $this->db->update('products', $data['sku'], $data);
            return $insert;
        }
        $insert = $this->db->insert('products', $data);
        return $insert;
    }
}