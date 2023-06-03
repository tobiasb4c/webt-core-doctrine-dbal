<?php
require_once 'vendor/autoload.php';

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

$config = new Configuration();
$connectionParams = [
    'dbname' => 'your_database_name',
    'user' => 'your_username',
    'password' => 'your_password',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
$connection = DriverManager::getConnection($connectionParams, $config);

//Holt id
$id = $_POST['id'];


$queryBuilder = $connection->createQueryBuilder();


$queryBuilder
    ->delete('game_rounds')
    ->where($queryBuilder->expr()->eq('id', ':id'));// Prüft wo Expression von Querry builder (expr()) gleich (eq())

$queryBuilder->execute();

echo 'Gelöscht';
?>
