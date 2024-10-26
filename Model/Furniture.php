<?php
namespace Product\Model;

class Book extends Product
{
    private string $dimensions;

    public function __construct(string $dimensions)
	{
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