<?php
session_start();
require_once "../confi.php";

$query = "SELECT * FROM leave_requests WHERE (leave_check = '0')";
$query_result = mysqli_query($conn, $query);


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Codeza - Employee Details</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top position-relative">
        <div class="container-fluid">
            <a class="navbar-brand fs-1 mx-1" href="#">Codeza - Employees Requests</a>

            <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">More</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">
                    <ul class="fs-5" style="list-style: none;">
                        <li>
                            <a style="text-decoration:none; color:black;" href="admin_home.php">Go to home page</a>
                        </li>
                    </ul>
                    <ul class="fs-5" style="list-style: none;">
                        <li>
                            <a style="text-decoration:none; color:black;" href="see_all_req.php">See All Requests</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="att-table my-1">
        <table class="table">
            <thead class="table-dark">
                <th>#</th>
                <th>Name</th>
                <th>Employee ID</th>
                <th>Message</th>
                <th>Date</th>
                <th>Check</th>
            </thead>

            <?php
            $counter = 1;
            while ($query_data = mysqli_fetch_assoc($query_result)) {
                $id = $query_data['emp_id'];
                $query2 = "SELECT name FROM employees WHERE('$id' = emp_id AND activeStatus = '1')";
                $query2_result = mysqli_query($conn, $query2);
                $query2_data = mysqli_fetch_assoc($query2_result);
                if(@mysqli_num_rows($query2_result) >= 1){
            ?>
                <tbody>
                    <td style="width:100px"><?php echo $counter; ?></td>
                    <td style="width:200px"><?php echo $query2_data['name']; ?></td>
                    <td style="width:150px"><?php echo $query_data['emp_id']; ?></td>
                    <td style="width:600px"><?php echo $query_data['reasons']; ?></td>
                    <td style="width:300px"><?php echo $query_data['req_date']; ?></td>
                    <td style="width:200px">
                        <form action="" method="POST"><button class="btn btn-dark fs-6 w-50" type="submit" name="readReq">Read</button></form>
                        <?php
                        if (isset($_POST['readReq'])) {
                            unset($_POST['readReq']);
                            $id = $query_data['emp_id'];
                            $date = $query_data['req_date'];
                            $query3 = "UPDATE leave_requests SET leave_check = '1' WHERE('$id' = emp_id AND req_date = '$date')";
                            $query3_result = mysqli_query($conn, $query3);
                        }
                        ?>

                    </td>
                </tbody>
            <?php
            }
                $counter++;
            }
            ?>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>

<?php

?>