<?php
ini_set("display_errors", 1);

require_once "./Autoloader.php";
require_once "./routes/main.php";

use Project\Core\Core;
use Project\Http\Route;
use Project\Cors\Cors;

Cors::register();
Core::dispatch(Route::routes());