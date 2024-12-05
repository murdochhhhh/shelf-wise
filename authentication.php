<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('db_connection.php');

// Retrieve JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['username']) && !empty($data['password'])) {
    $username = $data['username'];
    $password = $data['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {

        // Login successful, set session
        $_SESSION['username'] = $username;
        echo json_encode(['success' => true, 'message' => 'Login successful!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password!']);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Please provide both username and password!']);
}
?>