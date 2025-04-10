<?php
    session_start();
    if (!$_SESSION['loggedIn']) {
        header("location: ./login.php");
    }

    if (isset($_GET['q'])) {
        // Get the value of the 'q' parameter
        $q = $_GET['q'];
    
        // Redirect based on the value of 'q'
        if($q == 1) {
            header("Location: ./questions/q1/q1.php");
            exit();
        }
        elseif ($q == 2) {
            header("Location: ./questions/q2/q2.php");
            exit();
        } 
        elseif ($q == 3) {
            header("Location: ./questions/q3/q3.php");
            exit();
        } 
        elseif ($q == 4) {
            header("Location: ./questions/q4/q4.php");
            exit();
        }
        elseif ($q == 5) {
            header("Location: ./questions/q5/q5.php");
            exit();
        }
        // If 'q' value is something else, redirect to q4.php by default
        else {
            header("Location: ./questions/q4/q4.php");
            exit();
        }
    } else {
        // If 'q' is not set, redirect to q4.php by default
        header("Location: ./questions/q4/q4.php");
        exit();
    }
?>
