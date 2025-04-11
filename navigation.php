<?php
    session_start();

    /**
     * Check if the user is logged in. If not, redirect to the login page.
     * 
     * @return void
     */
    if (!$_SESSION['loggedIn']) {
        header("location: ./login.php");
    }

    /**
     * Check if the 'q' parameter is present in the URL and redirect the user accordingly.
     * Redirects to different question pages based on the value of the 'q' parameter.
     * If 'q' is not set or has an invalid value, redirects to the default question page (q4).
     * 
     * @return void
     */
    if (isset($_GET['q'])) {
        $q = $_GET['q'];
    
        if ($q == 1) {
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
        else {
            header("Location: ./questions/q4/q4.php");
            exit();
        }
    } 
    else {
        header("Location: ./questions/q4/q4.php");
        exit();
    }
?>
