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

$queryBuilder = $connection->createQueryBuilder();

// Tabelle erstellenn
$queryBuilder
    ->createTable('game_rounds')
    ->addColumn('id', 'integer', ['autoincrement' => true]) //ID wird automatisch erstellt
    ->addColumn('player1', 'string', ['length' => 255])
    ->addColumn('player2', 'string', ['length' => 255])
    ->addColumn('symbol1', 'string', ['length' => 255])
    ->addColumn('symbol2', 'string', ['length' => 255])
    ->addColumn('date_time', 'datetime')
    ->setPrimaryKey(['id']);

$queryBuilder->execute();

echo 'Tabelle erstellt';
?>
