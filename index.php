<?php
ini_set("display_errors", 1);
include './Autoloader.php';
use Project\Model\Book;
use Project\Controller\BookController;

/* $book = new Book(47289434, 'name', 32, 100); */
$controller = new BookController;
$books = $controller->getBooks();
echo '<pre>';
print_r($books);
?>