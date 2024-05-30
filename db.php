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
    // set the PDO error mode to exception
} catch(PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}

function getAllTasks($conn,$taskId){
     $sql = "SELECT * FROM `Tasks` WHERE '$taskId';";
        try {
            $result = $conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    return array();
}
?>