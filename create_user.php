<?php
// create_user.php
require 'db_connection.php';
require 'User.php';

$name = $_POST['name'];
$email = $_POST['email'];

$user = new User(null, $name, $email);
$user->createUser($conn);

header("Location: index.html");
?>