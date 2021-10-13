<?php
    require_once "confi.php";
    session_start();
    session_unset();
    session_destroy();
    mysqli_close($conn);
    header("location: Login/login.php");
?>