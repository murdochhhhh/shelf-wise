<?php

session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.html");
}

include('db_connection.php');


$query = "SELECT * FROM books";
$result = mysqli_query($con, $query);

$books = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>



<!DOCTYPE html>
<html>

<head>
  <title>login page</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="text-end p-2">
    <h4 style="padding-top: 20px;"><svg style="padding-right:15px;" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
      <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
    </svg><?php echo $_SESSION['username']; ?> </h4>
    <a style="text-align:center; margin-top: 10px; margin-left: 20px;" class="btn btn-success" href="aboutme.php">About me</a> 
    </div>
  <h1 style="font-weight: 900; font-size: 400%; margin-top: 50px; margin-bottom: 30px;"> Shelf-Wise </h2>
    <div class="page" style="border: 1px solid black; margin-top: 10px; margin-bottom: 10px; margin-left: 200px; margin-right: 200px;padding-left: 75px; padding-right: 75px; border-radius: 100px;">
    <table class="table border border-success b-3 text-start table-striped">
        <tr class="table table-success">
          <th style="font-weight: bold;">ID</td>
          <th>TITLE</th>
          <th>AUTHOR</th>
          <th>GENRE</th>
          <th>PUBLISH DATE</th>
          <th>DELETION</th>
        </tr>
        <?php
        foreach ($books as $book) {
          echo "<tr>";
          echo "<td>" . $book['id'] . "</td>";
          echo "<td>" . $book['title'] . "</td>";
          echo "<td>" . $book['author'] . "</td>";
          echo "<td>" . $book['genre'] . "</td>";
          echo "<td>" . $book['publish_date'] . "</td>";
          echo "<td>";
          echo '<button class="btn btn-sm test-danger" onclick="javascript:deletebook(' . $book['id'] . ')">';
          echo '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
</svg>';
          echo '</button>';
          echo '</td>';
          echo "</tr>";
        }
?>
    </div>

    <div class="p-4">
      <h1> Current books: </h1>



      </table>

      <img src="images/shelfwise-bookstack (1).png" alt="bookshelf" style="width: 100px; height: 99px; margin-top: 10px;">
    </div>
    <!-- <div style="border: 1px solid black; margin-top: 50px; margin-bottom: 100px; margin-left: 200px; margin-right: 200px;">
</div> -->

    <div id="message">
      <?php
      if (!empty($_GET['msg']) && $_GET['msg'] == 'bookdeleted') {  ?>
        <div style="margin-left:500px; margin-right:500px;" class="alert alert-success" role="alert"> Book deleted!
        </div>
      <?php } ?>

    </div>
    <a class="btn btn-outline-dark" href="addbooks.php">Add a book</a>

    <a class="btn btn-outline-danger" href="logout.php">Logout</a>

    <script>
      function deletebook(book_id) {


        // Prepare the data to be sent as JSON
        const data = {
          book_id: book_id
        };

        // console.log(JSON.stringify(data));

        // Send the data using fetch()
        fetch('deletebook.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
          })
          .then(response => response.json())
          .then(result => {
            if (result.success) {
              window.location.href = "homepage.php?msg=bookdeleted"; // Redirect on success
            } else {
              document.getElementById('message').innerText = result.message;
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
      }
    </script>

    <br> <img src="images/Image Remove Background.png" alt="bookshelf" style="width: 1500px; height:307px; margin-top: 10px; overflow: hidden;">
</body>

</html>