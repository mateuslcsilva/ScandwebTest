<?php
namespace Project\Model;
 
use Project\Connection\DatabaseConnection;

class Book extends Product
{
    private float $weight;
    private DatabaseConnection $db;

    public function __construct(int $sku, string $name, float $price, float $weight)
	{
        parent::__construct($sku, $name, $price);
		$this->weight = $weight;

        $db = new DatabaseConnection;
        $this->db = $db;
	}

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight(float $value)
    {
        $this->weight = $value;
    }

    public function save()
    {
        $data = [
            'sku' => parent::getSku(), 
            'name' => parent::getName(),
            'price' => parent::getPrice(),
            'weight' => $this->weight
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