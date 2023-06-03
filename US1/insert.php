<?php
require_once 'vendor/autoload.php';

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

// Create a connection to the database
$config = new Configuration();
$connectionParams = [
    'dbname' => 'tournament',
    'user' => 'god',
    'password' => 'god',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
$connection = DriverManager::getConnection($connectionParams, $config);

// Get the form data
$player1 = $_POST['player1'];
$player2 = $_POST['player2'];
$symbol = $_POST['symbol'];
$date_time = $_POST['date_time'];

// Insert the data into the database
$connection->insert('game_rounds', [
    'player1' => $player1,
    'player2' => $player2,
    'symbol' => $symbol,
    'date_time' => $date_time,
]);

echo 'Record inserted successfully.';
?>
