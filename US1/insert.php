<?php
require_once 'vendor/autoload.php';

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

$config = new Configuration();
$connectionParams = [
    'dbname' => 'tournament',
    'user' => 'god',
    'password' => 'god',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
$connection = DriverManager::getConnection($connectionParams, $config);

//Form auslesen
$player1 = $_POST['player1'];
$player2 = $_POST['player2'];
$symbol1 = $_POST['symbol1'];
$symbol2 = $_POST['symbol2'];
$date_time = $_POST['date_time'];

$queryBuilder = $connection->createQueryBuilder();

$queryBuilder
    ->insert('game_rounds')
    ->values([
        'player1' => ':player1',
        'player2' => ':player2',
        'symbol1' => ':symbol1',
        'symbol2' => ':symbol2',
        'date_time' => ':date_time',
    ])
    ->setParameter('player1', $player1)
    ->setParameter('player2', $player2)
    ->setParameter('symbol1', $symbol1)
    ->setParameter('symbol2', $symbol2)
    ->setParameter('date_time', $date_time);


$queryBuilder->execute();

echo 'Inserted';
?>