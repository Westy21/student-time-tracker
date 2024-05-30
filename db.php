<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TimeTracker";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    echo "database connection successfull!";
    // set the PDO error mode to exception
} catch(PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}
?>