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

// Create a schema manager
$schemaManager = $connection->getSchemaManager();

// Create a new schema
$schema = new \Doctrine\DBAL\Schema\Schema();

// Create a table for storing game rounds
$table = $schema->createTable('game_rounds');
$table->addColumn('id', 'integer', ['autoincrement' => true]);
$table->addColumn('player1', 'string', ['length' => 255]);
$table->addColumn('player2', 'string', ['length' => 255]);
$table->addColumn('symbol', 'string', ['length' => 255]);
$table->addColumn('date_time', 'datetime');
$table->setPrimaryKey(['id']);

// Create the table in the database
$sql = $schema->toSql($connection->getDatabasePlatform());
foreach ($sql as $query) {
    $connection->executeQuery($query);
}

echo 'Table created successfully.';
?>
