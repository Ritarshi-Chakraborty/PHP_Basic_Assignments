<!-- Implementing OOP concepts -->
<?php
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
    $imageSrc = $uploaded_image->returnPath();

    class displayResult {
        protected $table_array;

        function returnResult() {
            $this->table_array = explode("\n", $_POST['result']);
            foreach ($this->table_array as $key => $value) {
                $subject = explode('|', $value)[0];
                $marks = explode('|', $value)[1];
                echo "<tr>
                    <td>$subject</td>
                    <td>$marks</td>
                </tr>";
            }
        }
    }

    class validateNumber {
        protected $mobileRegex = "/^\+91 [6-9][0-9]{9}$/";
        protected $formattedNumber;

        function __construct($mobileNumber) {
            $this->formattedNumber = "+91 " . $mobileNumber;
        }

        function returnNumber() {
            if(preg_match($this->mobileRegex, $this->formattedNumber))
            {
                echo "Mobile Number: ".$this->formattedNumber;
            }
            else {
                echo "This number format is invalid! Please give a 10-digit Indian number";
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
            if(filter_var($this->email, FILTER_VALIDATE_EMAIL))
            {
                $response = file_get_contents($this->url);
                $data = json_decode($response, true);
                
                if($data["smtp_check"])
                {
                    echo "Email ID: " . $this->email;
                }
                else {
                    echo "This email id does not exist.";
                }
            }
            else {
                echo "Incoorect syntax for Email Id.";
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
        <h1><?php echo "Hello, ".$_POST['first_name']." ".$_POST['last_name']."!"; ?></h1>

        <!-- Displaying the mobile number -->
        <h3><?php $uploaded_number->returnNumber(); ?></h3>

        <!-- Displaying the email id -->
        <h3><?php $uploaded_email->returnEmail(); ?></h3>
        
        <!-- Displaying the uploaded image -->
        <div class="image-wrapper">
            <img src="<?php echo $imageSrc; ?>" alt="Uploaded Image">
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
                    $result = new displayResult();
                    $result->returnResult();
                ?>
            </tbody>
        </table>

        
    </div>
</body>
</html>
