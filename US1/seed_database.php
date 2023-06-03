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

// Insert test data
$data = [
    ['John', 'Jane', 'Rock', '2023-06-03 10:00:00'],
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
