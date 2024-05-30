<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <?php
    // Debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require('db.php');
    session_start();

    // When form submitted, check and create user session.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['username']); // Use trim() to remove whitespace

        if (!empty($username)) {
            // Prepare the SQL statement to prevent SQL injection
            $query = "SELECT * FROM Users WHERE name = :username";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $row['id'];
                // Redirect to user dashboard page
                header("Location: index.php");
                exit(); // Ensure no further code is executed
            } else {
                $error_message = "Incorrect Username.";
            }
        } else {
            $error_message = "Please enter a username.";
        }
    }
    ?>
    <!--Login Form -->
    <div class="form-popup login">
        <form method="post" class="form-container" autocomplete="off"
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1 class="login-title">Login</h1>
            <?php
            if (!empty($error_message)) {
                echo "<div class='error-message'>$error_message</div>";
            }
            ?>
            <input type="text" name="username" placeholder="Username" autocomplete="off" required />
            <input type="submit" value="Login" name="submit" class="btn" />
        </form>
    </div>
</body>

</html>