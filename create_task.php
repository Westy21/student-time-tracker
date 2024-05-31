<?php
// Debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('db.php');
require('Task.php');
include("auth_session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_name = trim($_POST['taskName']);
    $username = $_SESSION['username'];
    $userId = $_SESSION['userId'];
    $taskDuration = $_POST['taskDuration'];

    // Basic validation
    if (!empty($task_name)) {
        $taskName = $_POST['taskName'];
        $task = new Task(null, $userId, $taskName,$taskDuration,"default");
        $task->createTask($conn);
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Please fill in all the fields.";
    }
}
?>