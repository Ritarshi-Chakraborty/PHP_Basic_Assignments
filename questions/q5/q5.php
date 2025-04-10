<?php
    session_start();
    if (!$_SESSION['loggedIn']) {
        header("location: ../../login.php");
    }
    
    // Checking if we have submitted an invalid email previously
    $emailStatus = "";
    if (isset($_SESSION['email_error'])) {
        $emailStatus = $_SESSION['email_error'];
        unset($_SESSION['email_error']);
    }

    // Handling the email when submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Class to validate the email format and check if it exists
        class validateEmail {
            protected $email;
            protected $url;
            protected $api_key = "1e46e7b3020a047eb8b0fd4e522f78c8";

            // Constructor that initializes the email and the api url
            function __construct($email) {
                $this->email = $email;
                $this->url = "http://apilayer.net/api/check?access_key=$this->api_key&email=$email";
            }

            // Method to validate and return the email address
            function emailStatus() {
                $response = file_get_contents($this->url);
                $data = json_decode($response, true);
                if($data['format_valid']) {
                    if($data['smtp_check']) {
                        $_SESSION['userDetails']['email'] = $_POST['email'];
                        header("Location: ../../response.php");
                        exit;
                    }   
                    else {
                        $_SESSION['email_error'] = "This email id does not exist.";
                        header("Location: ".$_SERVER['PHP_SELF']);
                        exit;
                    }
                }
                else {
                    $_SESSION['email_error'] = "Incorrect syntax for Email Id."; 
                    header("Location: ".$_SERVER['PHP_SELF']);
                    exit;   
                }
            }
        }
        $uploaded_email = new validateEmail($_POST['email']);
        $uploaded_email->emailStatus();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 5</title>
    <link rel="stylesheet" href="../../style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="./q5.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Assignment 5</h1>
            <label>Enter your Email Id<span>*</span></label>
            <input type="text" name="email">
            <div class="message-box">
                <p class="<?php echo (!empty($emailStatus)) ? 'show-message' : ''; ?>">
                    <?php echo $emailStatus; ?>
                </p>
            </div>
            <button type="submit">Submit</button>
        </form>
        <div class="btn-wrapper">
            <a href="../../logout.php" title="Logout">Logout</a>
        </div>
    </div>
</body>
</html>
