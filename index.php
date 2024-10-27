<?php
include './Autoloader.php';
use Project\Model\Book;
use Project\Controller\BookController;

$book = new Book(47289432, 'name', 32, 100);

$controller = new BookController;
$controller->create($book);

/* echo '<pre>';
print_r($book);
exit; */


?>