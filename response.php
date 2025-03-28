<!-- Handling the uploaded image -->
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
