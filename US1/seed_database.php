<?php
require_once 'vendor/autoload.php';

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;

$config = new Configuration();
$connectionParams = [
    'dbname' => 'tournament',
    'user' => 'god',
    'password' => 'god',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
$connection = DriverManager::getConnection($connectionParams, $config);

// Insert
$data = [
    ['Tobi', 'Simon', 'Rock', 'Paper', '2023-06-03 10:00:00'],
    ['Fabi', 'Niko', 'Paper', 'Scissor', '2023-08-01 10:09:40'],
    ['Domi', 'Fabi', 'Scissor', 'Scissor', '2024-11-11 11:11:11'],
    ['Eros', 'Sergej', 'Rock', 'Paper', '2024-06-03 10:24:00'],
    ['Eros', 'NIko', 'Rock', 'Scissor', '2024-04-03 15:00:00'],
];

$queryBuilder = new QueryBuilder($connection);

// TYPO 3 Doku: This method creates a placeholder for a field value of a prepared statement. Always use this when dealing with user input in expressions to protect the statement from SQL injections
foreach ($data as $round) {
    $queryBuilder
        ->insert('game_rounds')
        ->values([
            'player1' => $queryBuilder->createNamedParameter($round[0]),
            'player2' => $queryBuilder->createNamedParameter($round[1]),
            'symbol1' => $queryBuilder->createNamedParameter($round[2]),
            'symbol2' => $queryBuilder->createNamedParameter($round[3]),
            'date_time' => $queryBuilder->createNamedParameter($round[4]),
        ])
        ->execute();
}

echo 'Seeded';
?>
