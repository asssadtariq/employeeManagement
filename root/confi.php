<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "employee management";
    $conn = mysqli_connect($servername, $username, $password, $database);

    if ($conn === false) {
        die("Connection Failed ");
    }
?>