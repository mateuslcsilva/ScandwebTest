<?php
ini_set("display_errors", 1);
/* ini_set("display_errors", 1);
include './Autoloader.php';

use Project\Model\Book;
use Project\Controller\BookController;
use Project\Model\DvdDisc;
use Project\Model\Furniture;

$data = [
    'sku' => 47289434,
    'name' => 'name',
    'price' => 32,
    'size' => 100,
    'type' => 'D'
];
function getController($data)
{
    return match ($data['type']) {
        'D' => new DvdDisc($data['sku'], $data['name'], $data['price'], $data['size']),
        'F' => new Furniture($data['sku'], $data['name'], $data['price'], $data['dimensions']),
        'B' => new Book($data['sku'], $data['name'], $data['price'], $data['weight']),
    };
}
$product = getController($data);
echo '<pre>';
print_r($product);
 */

require_once "./Autoloader.php";
require_once "./routes/main.php";

/* print_r($_GET);
exit; */

use Project\Core\Core;
use Project\Http\Route;

Core::dispatch(Route::routes());