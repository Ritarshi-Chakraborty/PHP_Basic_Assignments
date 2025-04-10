<?php
    session_start();
    $usernameError = "";
    $passwordError = "";

    if(isset($_SESSION['username-error'])) {
        $usernameError = $_SESSION['username-error'];
        unset($_SESSION['username-error']);
    }

    if(isset($_SESSION['password-error'])) {
        $passwordError = $_SESSION['password-error'];
        unset($_SESSION['password-error']);
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if ($username !== 'Ritam') {
            $_SESSION['username-error'] = "User not found.";
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } 
        elseif ($password !== 'Warner31') {
            $_SESSION['password-error'] = "Incorrect password.";
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } 
        else {
            $_SESSION['loggedIn'] = true;
            header("location: ./navigation.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h1>Login!</h1>
            <label>Enter your Username<span>*</span></label>
            <input type="text" name="username">
            <div class="message-box">
                <p class="username-message <?php echo (!empty($usernameError)) ? 'show-message' : ''; ?>"><?php echo $usernameError; ?></p>
            </div>
            <label>Enter your Password<span>*</span></label>
            <input type="password" name="password">
            <div class="message-box">
                <p class="password-message <?php echo (!empty($passwordError)) ? 'show-message' : ''; ?>"><?php echo $passwordError; ?></p>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
