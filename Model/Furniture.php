<?php
namespace Project\Model;

class Book extends Product
{
    private string $dimensions;

    public function __construct(int $sku, string $name, float $price, string $dimensions)
	{
        parent::__construct($sku, $name, $price);
		$this->dimensions = $dimensions;
	}

    public function getDimensions()
    {
        return $this->dimensions;
    }

    public function setDimensions(string $value)
    {
        $this->dimensions = $value;
    }
}