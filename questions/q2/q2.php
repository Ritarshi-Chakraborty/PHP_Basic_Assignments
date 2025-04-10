<?php
    session_start();
    if (!$_SESSION['loggedIn']) {
        header("location: ../../login.php");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Class to structure the Image src & move the file to the target directory
        class ImagePath {       
            protected $targetFile;

            // Constructor that handles the file upload
            function __construct($targetDir, $userImg) {
                $this->targetFile = $targetDir . basename($userImg["name"]);
                move_uploaded_file($userImg["tmp_name"], $this->targetFile);
            }

            // Method to return the path of the uploaded image
            function returnPath() {
                return $this->targetFile;
            }
        }
        $uploaded_image = new ImagePath("/var/www/Login_System/images/", $_FILES['image']);

        // Storing the image src in the session variable
        $_SESSION['userDetails']['image'] = $uploaded_image->returnPath();
        header("location: ../../navigation.php?q=3");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 2</title>
    <link rel="stylesheet" href="../../style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="./q2.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Assignment 2</h1>
            <label>Upload an Image<span>*</span></label>
            <input class="picture-input" type="file" name="image" accept="image/*">
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
