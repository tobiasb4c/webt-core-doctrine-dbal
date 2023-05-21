<?php
// insert_record.php
require 'vendor/autoload.php';
// Insert a new record into the database using Doctrine DBAL
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

$config = new Configuration();

// Database configuration (replace with your own)
$connectionParams = array(
    'dbname' => 'tournament',
    'user' => 'god',
    'password' => 'god',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);


$connection = DriverManager::getConnection($connectionParams, $config);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the information from the form
    $player = $_POST['player'];
    $symbol = $_POST['symbol'];
    $dateTime = date('Y-m-d H:i:s');

    // Insert the new record into the database
    $sql = "
    INSERT INTO game_rounds (player, symbol, date_time)
    VALUES
        ('$player', '$symbol', '$dateTime')
    ";

    $connection->executeStatement($sql);

    echo 'Record inserted successfully.';
}

// Display the form for inserting a new record
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>USARPS Championship - Insert Record</title>
    <style>

    </style>
</head>
<body>
    <h1>USARPS Championship - Insert Record</h1>
    <form method="POST" action="insert_record.php">
        <label for="player">Player:</label>
        <input type="text" name="player" id="player" required><br>

        <label for="symbol">Symbol:</label>
        <input type="text" name="symbol" id="symbol" required><br>

        <button type="submit">Insert Record</button>
    </form>
</body>
</html>
';

echo $html;
?>
