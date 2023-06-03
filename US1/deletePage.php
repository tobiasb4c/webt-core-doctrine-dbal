<?php
require_once 'vendor/autoload.php';

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

// Create a connection to the database
$config = new Configuration();
$connectionParams = [
    'dbname' => 'your_database_name',
    'user' => 'your_username',
    'password' => 'your_password',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
$connection = DriverManager::getConnection($connectionParams, $config);

// Get the record ID
$id = $_POST['id'];

// Delete the record from the database
$connection->delete('game_rounds', ['id' => $id]);

echo 'Record deleted successfully.';
?>
