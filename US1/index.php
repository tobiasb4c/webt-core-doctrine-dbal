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

//Alle Game Rounds bekommen
$queryBuilder = $connection->createQueryBuilder();
$queryBuilder->select('*')->from('game_rounds');
$gameRounds = $queryBuilder->execute()->fetchAll();


$html = '<table>';
$html .= '<tr><th>Player 1</th><th>Player 2</th><th>Symbol 1</th><th>Symbol 2</th><th>Date and Time</th></tr>';
foreach ($gameRounds as $round) {
    $html .= '<tr>';
    $html .= '<td>' . $round['player1'] . '</td>';
    $html .= '<td>' . $round['player2'] . '</td>';
    $html .= '<td>' . $round['symbol1'] . '</td>';
    $html .= '<td>' . $round['symbol2'] . '</td>';
    $html .= '<td>' . $round['date_time'] . '</td>';
    $html .= '</tr>';
}
$html .= '</table>';

echo $html;
?>
