<?php
    session_start();
    if (!$_SESSION['loggedIn']) {
        header("location: ../../login.php");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['userDetails']['name'] = $_POST['first_name']." ".$_POST['last_name'];
        header("location: ../../navigation.php?q=2");
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 1</title>
    <link rel="stylesheet" href="../../style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="./q1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="" id="name-form" method="post" enctype="multipart/form-data"> 
            <h1>Assignment 1</h1>
            <label>Enter your First name<span>*</span></label>
            <input type="text" name="first_name" maxlength="30">
            <div class="message-box">
                <p class="firstname-message">This field is required.</p>
            </div>
            <label>Enter your Last name<span>*</span></label>
            <input type="text" name="last_name" maxlength="30">
            <div class="message-box">
                <p class="lastname-message">This field is required.</p>
            </div>
            <label>Your Fullname</label>
            <input type="text" name="full_name" disabled required>
            <button type="submit">Next</button>
        </form>
        <div class="btn-wrapper">
            <a href="../../logout.php" title="Logout">Logout</a>
        </div>
    </div>
</body>
</html>
