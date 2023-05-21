<?php
// retrieve_data.php
require 'vendor/autoload.php';

// Retrieve data from the database using Doctrine DBAL and display in the view
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

// Fetch all game rounds from the database
$sql = "SELECT * FROM game_rounds";
$stmt = $connection->executeQuery($sql);
$gameRounds = $stmt->fetchAllAssociative();

// Display the game rounds in the view
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>USARPS Championship</title>
    <style>
        
    </style>
</head>
<body>
    <h1>USARPS Championship</h1>
    <p>Tournament Name: XYZ</p>
    <p>Date: 2023-05-21</p>
    <h2>Game Rounds</h2>
    <ul>';

foreach ($gameRounds as $gameRound) {
    $html .= '<li>Game ' . $gameRound['id'] . ' - Player: ' . $gameRound['player'] . ', Symbol: ' . $gameRound['symbol'] . ', Date: ' . $gameRound['date_time'] . '</li>';
}

$html .= '
    </ul>


    <a href="./insertPage.php">Insert</a>
    <a href="./deletePage.php">Delete</a>
</body>
</html>
';

echo $html;
?>
