<?php
// create_database.php
require 'vendor/autoload.php';
// Setup the database connection using Doctrine DBAL
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

$config = new Configuration();

// Connect to the MySQL server as the root user (adjust the connection parameters as needed)
$connectionParamsRoot = array(
    'user' => 'god',
    'password' => 'god',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);

$connectionRoot = DriverManager::getConnection($connectionParamsRoot, $config);

// Create the database (replace 'your_database_name' with the desired database name)
$databaseName = 'tournament';
$sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS $databaseName";
$connectionRoot->executeStatement($sqlCreateDatabase);

// Connect to the newly created database
$connection = DriverManager::getConnection($connectionParams, $config);

// Create the table for storing game rounds
$sqlCreateTable = "
CREATE TABLE IF NOT EXISTS game_rounds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    player VARCHAR(255),
    symbol ENUM('rock', 'paper', 'scissors'),
    date_time DATETIME
)";
$connection->executeStatement($sqlCreateTable);

echo 'Database and table created successfully.';
?>