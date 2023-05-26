<?php 

session_start();

if (!isset($_SESSION['LoggedInUser'])) {
    header('location: pages/login.php');
    exit();
}
?>