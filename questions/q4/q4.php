<?php
    session_start();
    if (!$_SESSION['loggedIn']) {
        header("location: ../../login.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['userDetails']['number'] = "+91".$_POST['number'];
        header("location: ../../navigation.php?q=1");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 4</title>
    <link rel="stylesheet" href="../../style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="./q4.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Assignment 4</h1>
            <label>Enter your mobile number<span>*</span></label>
            <input type="text" name="number">
            <div class="message-box">
                <p>Please enter a 10-digit Indian number starting with either 6, 7, 8 or 9.</p>
            </div>
            <button type="submit">Next</button>
        </form>
        <div class="btn-wrapper">
            <a href="../../logout.php" title="Logout">Logout</a>
        </div>
    </div>
</body>
</html>
