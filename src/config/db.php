<?php
$db_host = $_ENV['DATABASE_HOST'];
$db_username = $_ENV['DATABASE_USERNAME'];
$db_password = $_ENV['DATABASE_PASSWORD'];
$db_name = $_ENV['DATABASE_NAME'];

//config connect to DB
try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
