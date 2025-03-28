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
        <?php
            // $targetDir = "/images/";
            // $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            // if (! is_writable("/images/")) {
            //     die("Error: 'images/' folder is not writable.");
            // }
            // move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
        ?>
        <img src="<?php echo $targetFile; ?>" alt="Uploaded Image">

        <!-- Displaying the subject & marks from textarea in a table format -->
        <?php
            $table_array =  explode("\n", $_POST['result']);
            foreach ($table_array as $key => $value) {
                echo "$key => $value";
            } 
        ?>
        <table>
            <tr>
                
            </tr>
        </table>
    </div>
</body>
</html>