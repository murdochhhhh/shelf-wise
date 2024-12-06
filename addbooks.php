<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.html");
}
?>


<!DOCTYPE html>
<html>

<head>
  <title>login page</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
  <link rel="manifest" href="/manifest.jsonon">
  <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <h1 style="font-weight: 900; margin-top: 50px; font-size: 300%;">Shelf-Wise </h2>
    <div
      style="border: 1px solid black; margin-top: 10px; margin-bottom: 50px; margin-left: 200px; margin-right: 200px;">
    </div>

    <div class="page" style="margin: auto ; text-align: center; width: 300px; padding-bottom: 10px;">
      <h1 class="m-3"> Add books </h1>
      <form name="loginForm" id="loginForm" onsubmit="addBook(event)">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="author">Author:</label><br>
        <input type="author" id="author" name="author"><br>
        <label for="genre">Genre:</label><br>
        <input type="genre" id="genre" name="genre"><br>
        <label for="Pdate">Publish year:</label><br>
        <input type="Pdate" id="Pdate" name="Pdate">
        <br>
        <button type="submit" class="btn btn-outline-success m-3">Add book</button>
      </form>

      <img src="images/shelfwise-bookstack (1).png" alt="bookshelf" style="width: 100px; height: 100px;">
    </div>
    <div style="border: 1px solid black; margin-top: 50px; margin-bottom: 20px; margin-left: 200px; margin-right: 200px;">
    </div>
    <a type="button" style="text-align:left" class="btn btn-outline-danger" href="homepage.php">Back</a>
    <div id="ErrorMessage"></div>

    <script>
      function addBook(event) {
        event.preventDefault(); // Prevent the form from submitting the default way
        const title = document.getElementById('title').value;
        const author = document.getElementById('author').value;
        const genre = document.getElementById('genre').value;
        const Pdate = document.getElementById('Pdate').value;


        // Check if both fields are filled
        if (title === "" || author === "" || genre === "" || Pdate === "") {
          document.getElementById('ErrorMessage').innerText = "Please fill all fields";
          return;
        }
        // Prepare the data to be sent as JSON
        const data = {
          title: title,
          author: author,
          genre: genre,
          Pdate: Pdate
        };

        // console.log(JSON.stringify(data));

        // Send the data using fetch()
        fetch('createbook.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
          })
          .then(response => response.json())
          .then(result => {
            if (result.success) {
              window.location.href = "homepage.php"; // Redirect on success
            } else {
              document.getElementById('ErrorMessage').innerText = result.message;
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
      }
      if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
          navigator.serviceWorker.register('/service-worker.js')
            .then(reg => console.log('Service Worker registered!', reg))
            .catch(err => console.log('Service Worker registration failed!', err));
        });
      }
    </script>
</body>

</html>
