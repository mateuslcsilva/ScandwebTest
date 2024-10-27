<?php
namespace Project\Model;

class DvdDisc extends Product
{
    private float $size;

    public function __construct(int $sku, string $name, float $price, float $size)
	{
        parent::__construct($sku, $name, $price);
		$this->size = $size;
	}

    public function getSize()
    {
        return $this->size;
    }

    public function setSize(float $value)
    {
        $this->size = $value;
    }
}