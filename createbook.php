<?php

session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.html");
}

include('db_connection.php');
$book = json_decode(file_get_contents("php://input"), true);


if (!empty($book['title']) && !empty($book['author']) && !empty($book['genre']) && !empty($book['Pdate'])) {
    $title = $book['title'];
    $author = $book['author'];
    $genre = $book['genre'];
    $publish_date = $book['Pdate'];


    $query = "INSERT INTO `books` (`title`, `author`, `genre`, `publish_date`) VALUES ('$title', '$author', '$genre', '$publish_date');";
    $result = mysqli_query($con, $query);

    // Login successful, set session
    echo json_encode(['success' => true, 'message' => 'Login successful!']);
    //   } else {
    //     echo json_encode(['success' => false, 'message' => 'Invalid username or password!']);
    //   }
    
}
else {
    echo json_encode(['success' => false, 'message' => 'Please provide both username and password!']);
}
?>
