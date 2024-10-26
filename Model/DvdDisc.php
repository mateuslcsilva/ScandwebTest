<?php
namespace Product\Model;

class DvdDisc extends Product
{
    private float $size;

    public function __construct(float $size)
	{
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