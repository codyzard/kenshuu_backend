<?php
session_start();

require './core/Helper.php';
require './core/Database.php';
require './models/BaseModel.php';
require './controllers/BaseController.php';


$controllerName = ucfirst(strtolower($_REQUEST['controller']) ?: 'Home') . 'Controller';
$actionName = strtolower($_REQUEST['action'] ?? 'index');

require "./controllers/${controllerName}.php";

$controllerObj = new $controllerName;
$controllerObj->$actionName();

?>
