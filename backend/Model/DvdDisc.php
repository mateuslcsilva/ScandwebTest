<?php
namespace Project\Model;
 
use Project\Connection\DatabaseConnection;

class DvdDisc extends Product
{
    private float $size;
    private DatabaseConnection $db;

    public function __construct(string $sku, string $name, float $price, float $size)
	{
        parent::__construct($sku, $name, $price);
		$this->size = $size;

        $db = new DatabaseConnection;
        $this->db = $db;
	}

    public function getSize()
    {
        return $this->size;
    }

    public function setSize(float $value)
    {
        $this->size = $value;
    }

    public function save()
    {
        $data = [
            'sku' => parent::getSku(), 
            'name' => parent::getName(),
            'price' => parent::getPrice(),
            'size' => $this->size
        ];
        $skuExists = $this->db->selectCount('products', $data['sku']);
        if($skuExists > 0){
            return false;
        }
        $insert = $this->db->insert('products', $data);
        return $insert;
    }
}