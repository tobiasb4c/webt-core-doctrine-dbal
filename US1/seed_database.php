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

// Insert test data
$data = [
    ['Tobi', 'Simon', 'Rock', '2023-06-03 10:00:00'],
    ['Fabi', 'Niko', 'Paper', '2023-08-01 10:09:40'],
    ['Domi', 'Fabi', 'Scissor', '2024-11-11 11:11:11'],
    ['Eros', 'Sergej', 'Scissor', '2024-06-03 10:24:00'],
    ['Eros', 'NIko', 'Rock', '2024-04-03 15:00:00'],
    // Add more test data
];

foreach ($data as $round) {
    $connection->insert('game_rounds', [
        'player1' => $round[0],
        'player2' => $round[1],
        'symbol' => $round[2],
        'date_time' => $round[3],
    ]);
}

echo 'Test data inserted successfully.';
?>
