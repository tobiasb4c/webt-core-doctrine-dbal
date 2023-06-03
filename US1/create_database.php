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

$schemaManager = $connection->getSchemaManager();

// Schema weil Queerybuilder nicht für Tabellen erstellung gedacht ist
$schema = new \Doctrine\DBAL\Schema\Schema();


$table = $schema->createTable('game_rounds');
$table->addColumn('id', 'integer', ['autoincrement' => true]);
$table->addColumn('player1', 'string', ['length' => 255]);
$table->addColumn('player2', 'string', ['length' => 255]);
$table->addColumn('symbol1', 'string', ['length' => 255]);
$table->addColumn('symbol2', 'string', ['length' => 255]);
$table->addColumn('date_time', 'datetime');
$table->setPrimaryKey(['id']);


$sql = $schema->toSql($connection->getDatabasePlatform());
foreach ($sql as $query) {
    $connection->executeQuery($query);
}

echo 'Tabelle erstelllt';
?>
