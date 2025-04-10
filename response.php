<?php
    session_start();
    if (!$_SESSION['loggedIn']) {
        header("location: ./login.php");
    }
    $userDetails = $_SESSION['userDetails'];
    $imagePath = './images/' . basename($userDetails['image']);
    // Returns an array: [width, height, type, attr]
    $imageSize = getimagesize($imagePath); 
    $imageWidth = $imageSize[0];
    $imageHeight = $imageSize[1];

    // Class to return the result in a table format
    class DisplayResult {
        protected $table_array;

        // Constructor that initializes the result array
        function __construct($result_array) {
            $this->table_array = $result_array;
        }

        // Method to format and return the result data as an HTML table
        function returnResult() {
            $table = '';
            foreach ($this->table_array as $value) {
                $subject = trim(explode('|', $value)[0]);
                $marks = trim(explode('|', $value)[1]);
                $table.="<tr>
                    <td>$subject</td>
                    <td>$marks</td>
                </tr>";
            }
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
