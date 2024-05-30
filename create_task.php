<?php
session_start();
require('db.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_name = trim($_POST['task_name']);
    $username = $_SESSION['username'];

    // Basic validation
    if (!empty($task_name) && !empty($task_description)) {
        try {
            // Insert the new task into the database
            $query = "INSERT INTO tasks (task_name, created_by) VALUES (:task_name, :created_by)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':task_name', $task_name);
            $stmt->bindParam(':created_by', $username);

            if ($stmt->execute()) {
                // Redirect to the dashboard or tasks page
                header("Location: tasks.php");
                exit();
            } else {
                $error_message = "Failed to create the task. Please try again.";
            }
        } catch (PDOException $e) {
            $error_message = "Database error: " . $e->getMessage();
        }
    } else {
        $error_message = "Please fill in all the fields.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Create Task</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <div class="form-popup create-task">
        <form method="post" class="form-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1 class="form-title">Create Task</h1>
            <?php
            if (!empty($error_message)) {
                echo "<div class='error-message'>$error_message</div>";
            }
            ?>
            <input type="text" name="task_name" placeholder="Task Name" required />
            <textarea name="task_description" placeholder="Task Description" required></textarea>
            <input type="submit" value="Create Task" class="btn" />
        </form>
    </div>
</body>

</html>