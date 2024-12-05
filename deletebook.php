<?php

session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.html");
}

include('db_connection.php');
$book = json_decode(file_get_contents("php://input"), true);


if (!empty($book['book_id'])) {
    $book_id = $book['book_id'];


    $query = "DELETE FROM books WHERE id='$book_id'";
    $result = mysqli_query($con, $query);

    // Login successful, set session
    echo json_encode(['success' => true, 'message' => 'book deleted!']);
    //   } else {
    //     echo json_encode(['success' => false, 'message' => 'Invalid username or password!']);
    //   }
    
}
else {
    echo json_encode(['success' => false, 'message' => 'Please provide both username and password!']);
}
?>
