<?php
namespace Product\Model;

class Book extends Product
{
    private float $weight;

    public function __construct(float $weight)
	{
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