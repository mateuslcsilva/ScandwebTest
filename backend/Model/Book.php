<?php
namespace Project\Model;
 
use Project\Connection\DatabaseConnection;

class Book extends Product
{
    private string $weight;
    private DatabaseConnection $db;

    public function __construct(string $sku, string $name, float $price, string $weight)
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

    public function setWeight(string $value)
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
            return false;
        }
        $insert = $this->db->insert('products', $data);
        return $insert;
    }
}