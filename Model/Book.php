<?php
namespace Project\Model;

class Book extends Product
{
    private float $weight;

    public function __construct(int $sku, string $name, float $price, float $weight)
	{
        parent::__construct($sku, $name, $price);
		$this->weight = $weight;
	}

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight(float $value)
    {
        $this->weight = $value;
    }
}