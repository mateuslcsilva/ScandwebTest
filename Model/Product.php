<?php
namespace Product\Model;

class Product
{
    private int $sku;
    private string $name;
    private float $price;
    
    public function __construct(int $sku, string $name, float $price)
	{
		$this->sku = $sku;
		$this->name = $name;
		$this->price = $price;
	}

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku(int $value)
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
}