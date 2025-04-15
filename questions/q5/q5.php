<?php
    session_start();

    /**
     * Redirects to the login page if the user is not logged in.
     */
    if (!$_SESSION['loggedIn']) {
        header("location: ../../login.php");
    }

    // Include the dotenv library
    require_once __DIR__ . '/../../vendor/autoload.php';

    // Load the .env file
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../../');
    $dotenv->load();

    /**
     * Checks if there was a previous email error stored in the session.
     * If an error is present, it stores the error message in $emailStatus and unsets the session variable.
     */
    $emailStatus = "";
    if (isset($_SESSION['email_error'])) {
        $emailStatus = $_SESSION['email_error'];
        unset($_SESSION['email_error']);
    }

    /**
     * Handles email validation when the form is submitted using the POST method.
     */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        /**
         * Class to validate the email format and check if the email exists using an external API.
         * This class communicates with the email validation service and performs necessary checks.
         */
        class validateEmail {
            
            /**
             * @var string $email The email address to be validated.
             */
            protected $email;

            /**
             * @var string $url The URL for the email validation API request.
             */
            protected $url;

            /**
             * @var string $api_key The API key to access the validation service.
             */
            protected $api_key;

            /**
             * Constructor to initialize the email and prepare the API request URL.
             *
             * @param string $email The email address to be validated.
             */
            function __construct($email) {
                /**
                 * Sets the email and constructs the URL for the API request.
                 */
                $this->email = $email;
                $this->api_key = $_ENV['APIKEY'];
                $this->url = "http://apilayer.net/api/check?access_key=$this->api_key&email=$email";
            }

            /**
             * Method to check the validity of the email address.
             * The method sends a request to the API to check the format and existence of the email.
             * If valid, the email is stored in the session; otherwise, an error message is set.
             *
             * @return void
             */
            function emailStatus() {
                /**
                 * Sends a request to the API and checks the response for email validity.
                 */
                $response = file_get_contents($this->url);
                $data = json_decode($response, true);

                /**
                 * If the email format is valid, proceed to check the existence of the email.
                 */
                if ($data['format_valid']) {
                    /**
                     * If SMTP check is successful, store the email in the session and redirect to the response page.
                     */
                    if ($data['smtp_check']) {
                        $_SESSION['userDetails']['email'] = $_POST['email'];
                        /**
                         * Set the flag to indicate that the email has been validated and the form is submitted
                         */
                        $_SESSION['email_sent'] = true;
                        header("Location: ../../response.php");
                        exit;
                    } 
                    else {
                        /**
                         * If the email does not exist, set an error message and redirect back to the form.
                         */
                        $_SESSION['email_error'] = "This email id does not exist.";
                        header("Location: ".$_SERVER['PHP_SELF']);
                        exit;
                    }
                } 
                else {
                    /**
                     * If the email format is invalid, set an error message and redirect back to the form.
                     */
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
        <form action="" method="post" id="email-form" enctype="multipart/form-data">
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
