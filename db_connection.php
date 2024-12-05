<?php
$host = "localhost";
$user = "admin";

$password = "test"; // MAMP default password
$db_name = "library"; // Your database name

// Establish the database connection
$con = mysqli_connect($host, $user, $password, $db_name);

// Check the connection
if (mysqli_connect_errno()) {
die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>