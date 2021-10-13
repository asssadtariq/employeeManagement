<?php
session_start();
require_once "../confi.php";

if (isset($_POST['name']) && isset($_POST['amount']) && isset($_POST['date'])){
    $name = $_POST['name'];
    $name = strtoupper($name);
    $date = $_POST['date'];
    $amount = $_POST['amount'];

    $query = "INSERT INTO expenses VALUES(NULL, '$name', '$amount', '$date')";
    $query_result = mysqli_query($conn, $query);

    if ($query_result){
        echo "Expense Added Successfully";
    }

    else {
        echo "Expense Insertion Failed !!!";
    }
}

if (isset($_POST['uppID']) && isset($_POST['uppName']) && isset($_POST['uppAmount']) && isset($_POST['uppDate'])){
    $id = $_POST['uppID'];
    $name = $_POST['uppName'];
    $name = strtoupper($name);
    $date = $_POST['uppDate'];
    $amount = $_POST['uppAmount'];

    $query = "UPDATE expenses SET expense_name = '$name', amount = '$amount', exp_date = '$date' WHERE(exp_id = '$id')";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn)){
        echo "Expense Updated Successfully";
    }

    else {
        echo "Expense Updation Failed !!!";
    }

}

if (isset($_POST['delID'])){
    $id = $_POST['delID'];

    $query = "DELETE FROM expenses WHERE(exp_id = '$id')";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn)){
        echo "Expense Deleted Successfully";
    }

    else {
        echo "Expense Deletion Failed !!!";
    }

}

?>