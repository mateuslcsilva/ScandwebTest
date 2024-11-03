<?php
namespace Project\Controller;

use Project\Model\DvdDisc;

class DvdController
{
    public function store($data)
    {
        $dvdDisc = new DvdDisc($data['sku'], $data['name'], $data['price'], $data['size']);
        return $dvdDisc->save();
    }
}