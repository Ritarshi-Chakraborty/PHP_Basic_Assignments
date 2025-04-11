<?php
    session_start();
    if (!$_SESSION['loggedIn']) {
        header("location: ../../login.php");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['userDetails']['result'] = explode("\n", $_POST['result']);
        header("location: ../../navigation.php?q=5");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 3</title>
    <link rel="stylesheet" href="../../style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="./q3.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Assignment 3</h1>
            <label>Enter your Subjects and Marks<span>*</span></label>
            <textarea placeholder="Please use the following format: English|80" name="result"></textarea>
            <div class="message-box">
                <p></p>
            </div>
            <button type="submit">Next</button>
        </form>
        <div class="btn-wrapper">
            <a href="../../logout.php" title="Logout">Logout</a>
        </div>
    </div>
</body>
</html>
