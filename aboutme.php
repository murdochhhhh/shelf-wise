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
    <link rel="manifest" href="/manifest.jsonon">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h4 style="margin-left: 1500px; padding-top: 20px;"><svg style="padding-right:15px;" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
        </svg><?php echo $_SESSION['username']; ?> <a style="text-align:center; margin-top: 10px; margin-left: 50px;" class="btn btn-outline-danger" href="homepage.php">Back</a> </h4>
    <h1 style="font-weight: 900; font-size: 400%; margin-top: 10px; margin-bottom: 15px;"> About me </h2>
        <div style="border: 1px solid black; margin-top: 1px; margin-bottom: 10px; margin-left: 180px; margin-right: 180px; background-color:floralwhite; padding-left: 75px; padding-right: 75px; border-radius: 100px;">
            <h5 style="margin: 25px;"> As someone who has always found solace and inspiration in the pages of a good book, I’ve long believed in the magic of storytelling and its ability to transport us to other worlds. Reading has been my constant companion, a cherished escape during quiet afternoons or late nights when the world feels still. I wanted to create a space where others could share in that joy—a website that celebrates the beauty of books and fosters a community of fellow book lovers. While I didn’t have the technical skills to build it myself, I knew I needed someone who could bring my vision to life. That’s where my collaboration with this talented designer came in. Together, we’ve crafted a digital sanctuary for readers, a place to discover, discuss, and revel in the stories that shape us.</h5>
            <div>
                <img src="images/readingbook.png" alt="bookshelf" style="width: 750px; height: 500px;margin-bottom: 20px; border: 5px solid black;">
            </div>
        </div>

        </div>

        <script>
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