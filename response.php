<?php
    session_start();

    /**
     * Check if the user is logged in. If not, redirect to the login page.
     */
    if (!$_SESSION['loggedIn']) {
        header("location: ./login.php");
    }
    /**
     * Retrieve the user details from the session.
     * User details are stored in the session variable 'userDetails'.
     */
    $userDetails = $_SESSION['userDetails'];
    /**
     * Build the path to the user's uploaded image.
     * Uses the basename function to avoid directory traversal vulnerabilities.
     */
    $imagePath = './images/' . basename($userDetails['image']);
    /**
     * Retrieve the size of the image (width, height, type, and attributes).
     * The getimagesize function returns an array with this information.
     *
     * @var array $imageSize Array containing width, height, type, and attributes of the image.
     */
    $imageSize = getimagesize($imagePath); 
    $imageWidth = $imageSize[0];
    $imageHeight = $imageSize[1];

    /**
     * Class to format and display user results as an HTML table.
     */
    class DisplayResult {
        protected $table_array;

        /**
         * Constructor to initialize the result array.
         * The result array contains the subjects and marks.
         * 
         * @param array $result_array The array of result data in 'subject|marks' format.
         */
        function __construct($result_array) {
            $this->table_array = $result_array;
        }

        /**
         * Method to format the result data into HTML table rows.
         * It processes the input data and returns a table of subjects and marks.
         * 
         * @return string HTML table rows containing subjects and marks.
         */
        function returnResult() {
            $table = '';

            /**
             * Loop through the result array and extract subject and marks
             * using the '|' delimiter.
             */
            foreach ($this->table_array as $value) {
                $subject = trim(explode('|', $value)[0]);
                $marks = trim(explode('|', $value)[1]);

                /**
                 * Format the subject and marks into a table row.
                 */
                $table .= "<tr>
                    <td>$subject</td>
                    <td>$marks</td>
                </tr>";
            }

            /**
             * Return the generated table rows as a string.
             */
            return $table;
        }
    }

    $result = new DisplayResult($userDetails['result']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response</title>
    <link rel="stylesheet" href="./style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</head>
<body>
    <div class="container">
        <h1>Hello, <?php echo $userDetails['name']; ?>!</h1>
        <h3>Phone Number >>>> <?php echo $userDetails['number']; ?></h3>
        <h3 class="email">Email >>>> <?php echo $userDetails['email']; ?></h3>
        <div class="image-wrapper" data-width="<?php echo $imageWidth; ?>" data-height="<?php echo $imageHeight; ?>">
            <img src="<?php echo $imagePath; ?>" alt="Uploaded Image">
        </div>
        <table>
            <tr>
                <th>Subject</th>
                <th>Marks</th>
            </tr>
            <?php
                echo $result->returnResult();
            ?>
        </table>
        <div class="btn-wrapper">
            <a href="./download.php" title="Download">Download your Data</a>
            <a href="../logout.php" title="Logout">Logout</a>
        </div>
    </div>
</body>
</html>
