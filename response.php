<!-- Implementing OOP concepts -->
<?php
    $fullName = $_POST['first_name']." ".$_POST['last_name'];
    $result_array = explode("\n", $_POST['result']);

    class ImagePath {       
        protected $targetFile;

        function __construct($targetDir) {
            $this->targetFile = $targetDir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $this->targetFile);
        }

        function returnPath() {
            return $this->targetFile;
        }
    }
    $uploaded_image = new ImagePath("./images/");

    class DisplayResult {
        protected $table_array;

        function __construct($result_array) {
            $this->table_array = $result_array;
        }

        function returnResult() {
            $table = '';
            foreach ($this->table_array as $value) {
                $subject = explode('|', $value)[0];
                $marks = explode('|', $value)[1];
                $table.="<tr>
                    <td>$subject</td>
                    <td>$marks</td>
                </tr>";
            }
            return $table;
        }
    }
    $result = new DisplayResult($result_array);

    class validateNumber {
        protected $mobileRegex = "/^\+91 [6-9][0-9]{9}$/";
        protected $formattedNumber;

        function __construct($mobileNumber) {
            $this->formattedNumber = "+91 " . $mobileNumber;
        }

        function returnNumber() {
            if(preg_match($this->mobileRegex, $this->formattedNumber))
            {
                return $this->formattedNumber;
            }
            else {
                return "This number format is invalid! Please give a 10-digit Indian number";
            }
        }
    }
    $uploaded_number = new validateNumber($_POST['number']);

    class validateEmail {
        protected $email;
        protected $url;

        function __construct($email) {
            $this->email = $email;
            $this->url = "http://apilayer.net/api/check?access_key=1e46e7b3020a047eb8b0fd4e522f78c8&email=$email";
        }

        function returnEmail() {
            $response = file_get_contents($this->url);
            $data = json_decode($response, true);
            if($data['format_valid'])
            {
                if($data['smtp_check'])
                {
                    return $this->email;
                }
                else {
                    return "This email id does not exist";
                }
            }
            else {
                return "Incorect syntax for Email Id.";
            }
        }
    }
    $uploaded_email = new validateEmail($_POST['email']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Welcoming the user with his/her name -->
        <h1><?php echo "Hello, ".$fullName."!"; ?></h1>

        <!-- Displaying the mobile number -->
        <h3><?php echo "Mobile Number: ".$uploaded_number->returnNumber(); ?></h3>

        <!-- Displaying the email id -->
        <h3 class="email"><?php echo "Email: ". $uploaded_email->returnEmail(); ?></h3>
        
        <!-- Displaying the uploaded image -->
        <div class="image-wrapper">
            <img src="<?php echo $uploaded_image->returnPath(); ?>" alt="Uploaded Image">
        </div>
       
        <!-- Displaying the subject & marks from textarea in a table format -->
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    echo $result->returnResult();
                ?>
            </tbody>
        </table>

        <!-- Sending the user details to another php file using SESSIONS -->
        <?php
            session_start();
            $_SESSION['userDetails'] = [
                'name' => $fullName,
                'image' => $uploaded_image->returnPath(),
                'number' => $uploaded_number->returnNumber(),
                'email' => $uploaded_email->returnEmail(),
                'result' => $result_array
            ];
        ?>

        <!-- Download button -->
        <div class="btn-wrapper">
            <a href="./download.php" title="Download your Form">Download your Form</a>
        </div>
    </div>
</body>
</html>
