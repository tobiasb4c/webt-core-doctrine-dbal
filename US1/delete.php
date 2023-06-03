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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $queryBuilder = $connection->createQueryBuilder();

    $queryBuilder
        ->delete('game_rounds')
        ->where($queryBuilder->expr()->eq('id', ':id')) // Prüft wo Expression von Querry builder (expr()) gleich (eq()) id
        ->setParameter('id', $_POST['id']);
        
    $queryBuilder->execute();

    echo 'Deleted';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete</title>
</head>
<body>
  <form action="delete.php" method="POST">
    <label for="id">ID:</label>
    <input type="text" name="id" required><br>

    <input type="submit" value="Delete">
  </form>
</body>
</html>