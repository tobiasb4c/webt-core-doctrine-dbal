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
    // Get the record ID to delete
    $id = $_POST['id'];

    // Delete the record from the database
    $sql = "DELETE FROM game_rounds WHERE id = $id";
    $connection->executeStatement($sql);

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
        <label for="id">Record ID:</label>
        <input type="number" name="id" id="id" required><br>

        <button type="submit">Delete Record</button>
    </form>
    
</body>
</html>
';

echo $html;
?>
