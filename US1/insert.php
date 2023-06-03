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
    //Form auslesen
    $player1 = $_POST['player1'];
    $player2 = $_POST['player2'];
    $symbol1 = $_POST['symbol1'];
    $symbol2 = $_POST['symbol2'];
    $date_time = $_POST['date_time'];

    // Datum und Uhrzeit formatieren
    $formattedDateTime = date('Y-m-d H:i:s', strtotime($date_time));

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
        ->setParameter('date_time', $formattedDateTime);

    $queryBuilder->execute();

    echo 'Inserted';
}
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
  <form action="insert.php" method="POST">
    <label for="player1">Player 1:</label>
    <input type="text" name="player1" required><br>

    <label for="player2">Player 2:</label>
    <input type="text" name="player2" required><br>

    <label for="symbol">Symbol 1:</label>
    <input type="text" name="symbol1" required><br>
    
    <label for="symbol">Symbol 2:</label>
    <input type="text" name="symbol2" required><br>

    <label for="date_time">Datum und Zeit:</label>
    <input type="datetime-local" name="date_time" required><br>

    <input type="submit" value="Submit">
  </form>
</body>
</html>