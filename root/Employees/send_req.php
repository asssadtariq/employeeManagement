<?php
    session_start();
    require_once "../confi.php";

    if (isset($_POST['empReason']) && isset($_POST['reqDate'])){
        $id = $_SESSION['current_user'];
        $reason = $_POST['empReason'];
        $date = $_POST['reqDate'];

        $query = "INSERT INTO leave_requests VALUES (NULL, '$id', '$reason', '$date', '0')";
        mysqli_query($conn, $query);

        if (mysqli_affected_rows($conn)){
            echo "Leave Request Send Successfully";
        }

        else {
            echo "Leave Request Sending Failed !!!";
        }

    }



?>