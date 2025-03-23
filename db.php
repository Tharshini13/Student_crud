<?php
include 'config.php';

$connection = mysqli_connect("localhost", "root", "", "studentss");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
