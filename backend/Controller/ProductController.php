<?php

namespace Project\Controller;

use Project\Controller\BookController;
use Project\Controller\DvdController;
use Project\Controller\FurnitureController;
use Project\Http\Request;
use Project\Http\Response;
use Project\Model\Product;

class ProductController
{
    public function store(Request $request, Response $response) 
    {
        $body = $request::body();

        $controller = match ($body['type']) {
            'D' => new DvdController,
            'F' => new FurnitureController,
            'B' => new BookController,
        };

        $result = $controller->store($body);
        
        if($result != true){
            $response::json([
                'error'   => true,
                'success' => false,
                'message'    => $result
            ], 500);
        }
        
        $response::json([
            'error'   => false,
            'success' => true,
            'message'    => 'Product information saved successfully!'
        ], 201);
    }

    public function fetch(Request $request, Response $response)
    {
        $products = Product::getAll();

        $response::json([
            'error'   => false,
            'success' => true,
            'products'    => $products
        ], 201);
    }

    public function deleteAll(Request $request, Response $response)
    {
        Product::deleteAll();        
        $response::json([
            'error'   => false,
            'success' => true,
            'message'    => 'Products deleted successfully'
        ], 201);
    }

    public function massDelete(Request $request, Response $response)
    {
        $body = $request::body();

        $result = Product::massDelete($body['skus']);
        if($result == true){
            $response::json([
                'error'   => false,
                'success' => true,
                'message'    => 'Products deleted successfully'
            ], 201);
            exit;
        }
        $response::json([
            'error'   => true,
            'success' => false,
            'message'    => $result
        ], 500);
    }
}
