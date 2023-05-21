<?php
// delete_record.php
require 'vendor/autoload.php';
// Delete a record from the database using Doctrine DBAL
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
    // Get the player name to delete
    $player = $_POST['player'];

    // Delete the record from the database
    $sql = "DELETE FROM game_rounds WHERE player = :player";
    $params = ['player' => $player];
    $types = ['player' => \PDO::PARAM_STR];
    $connection->executeStatement($sql, $params, $types);

    echo 'Record deleted successfully.';
}

// Display the form for deleting a record
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>USARPS Championship - Delete Record</title>
    <style>
        /* CSS für die responsive Darstellung */
    </style>
</head>
<body>
    <h1>USARPS Championship - Delete Record</h1>
    <form method="POST" action="delete_record.php">
        <label for="player">Player Name:</label>
        <input type="text" name="player" id="player" required><br>

        <button type="submit">Delete Record</button>
    </form>
</body>
</html>
';

echo $html;
?>
