<?php
require_once 'vendor/autoload.php';

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

// Create a connection to the database
$config = new Configuration();
$connectionParams = [
    'dbname' => 'your_database_name',
    'user' => 'your_username',
    'password' => 'your_password',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
$connection = DriverManager::getConnection($connectionParams, $config);

// Get the record ID
$id = $_POST['id'];

// Delete the record from the database
$connection->delete('game_rounds', ['id' => $id]);

echo 'Record deleted successfully.';



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
