<?php
session_start();

require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require './core/Database.php';
require './core/Helper.php';
require './models/BaseModel.php';
require './controllers/BaseController.php';





$controllerName = ucfirst(strtolower($_REQUEST['controller']) ?: 'Home') . 'Controller';
$actionName = strtolower($_REQUEST['action'] ?? 'index');

require "./controllers/${controllerName}.php";

$controllerObj = new $controllerName;
$controllerObj->$actionName();

?>
