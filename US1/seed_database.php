<?php
// seed_database.php
require 'vendor/autoload.php';

// Insert test data into the database using Doctrine DBAL
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

$config = new Configuration();

// Database configuration (replace with your own)
$connectionParams = array(
    'dbname' => 'tournament',
    'user' => 'god',
    'password' => 'god',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);

$connection = DriverManager::getConnection($connectionParams, $config);

// Insert test data
$sql = "
INSERT INTO game_rounds (player, symbol, date_time)
VALUES
    ('John', 'rock', '2023-05-21 10:00:00'),
    ('Alice', 'paper', '2023-05-21 11:00:00'),
    ('Bob', 'scissors', '2023-05-21 12:00:00'),
    ('Sarah', 'rock', '2023-05-21 13:00:00'),
    ('Mike', 'paper', '2023-05-21 14:00:00')
";

$connection->executeStatement($sql);

echo 'Test data inserted successfully.';
?>
