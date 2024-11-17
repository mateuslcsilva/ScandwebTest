<?php
namespace Project\Model;
 
use Project\Connection\DatabaseConnection;

class Product
{
    private string $sku;
    private string $name;
    private float $price;
    
    public function __construct(string $sku, string $name, float $price)
	{
		$this->sku = $sku;
		$this->name = $name;
		$this->price = $price;
	}

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku(string $value)
    {
        $this->sku = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $value)
    {
        $this->name = $value;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(float $value)
    {
        $this->price = $value;
    }

    static function getAll()
    {

        $db = new DatabaseConnection;
        
        $retorno = $db->select("select * from products");
        $products = [];
        foreach ($retorno as $key => $value) {
            array_push($products, $value);
        }
        return $products;
    }

    static function deleteAll()
    {

        $db = new DatabaseConnection;
        
        $retorno = $db->query("delete from products");
        return $retorno;
    }

    static function massDelete($skus)
    {

        $db = new DatabaseConnection;

        foreach ($skus as $key => $value) {
            $skus[$key] = "'$value'";
        }
        
        $retorno = $db->query("delete from products where sku in (" . implode(',', $skus) . ")");
        return $db->getError() != '' ? $db->getError() : true;
    }
}