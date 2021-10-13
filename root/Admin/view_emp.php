<?php
session_start();
require_once "../confi.php";
$query = "SELECT count(emp_id) AS tot_emp FROM employees";
$query_result = mysqli_query($conn, $query);
$query_data = mysqli_fetch_assoc($query_result);

$totalEmp = $query_data['tot_emp'];

$query2 = "SELECT * FROM employees WHERE(activeStatus = '1') ORDER BY emp_id ASC";
$query2_result = mysqli_query($conn, $query2);

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
            <a class="navbar-brand fs-1 mx-1" href="#">Codeza - Employees Information</a>

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
                </div>
            </div>
        </div>
    </nav>

    <div class="att-table my-1">
        <div class="emp-info d-flex my-3">
            <h1 class="fs-2 text-left mx-2 w-50">Total Employees</h1>
            <h1 class="fs-2 mx-4 w-50" style="text-align: right;"><?php echo $totalEmp; ?></h1>
        </div>
        <hr>
        <div class="search-box">
            <form action="" method="POST">
                <div class="input-group mb-3" style="margin-left: 5px; height: 50px;">
                    <input type="text" name="searchVal" class="form-control" placeholder="Search here" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-dark" name="searchBtn" style="width: 10%; margin-right: 10px;" type="submit" id="button-addon2">Search</button>
                    <button class="btn btn-dark" name="dispAll" style="width: 10%; margin-right: 10px;" type="submit" id="button-addon2">Display All</button>
                </div>
            </form>
            <?php
            if (isset($_POST['searchBtn'])) {
                unset($_POST['searchBtn']);
                $search_val = $_POST['searchVal'];
                $query2 = "SELECT * FROM employees WHERE(emp_id = '$search_val')";
                $query2_result = mysqli_query($conn, $query2);
                if (@mysqli_num_rows($query2_result) <= 0) {
                    $query3 = "SELECT * FROM employees WHERE(name LIKE '%$search_val%') ORDER BY emp_id ASC";
                    $query2_result = mysqli_query($conn, $query3);
                }
            }
            ?>
        </div>

        <table class="table">
            <thead class="table-dark">
                <th>#</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Father Name</th>
                <th>CNIC</th>
                <th>Nationality</th>
                <th>DOB</th>
                <th>Blood Group</th>
                <th>DOJ</th>
                <th>Rank</th>
                <th>Salary</th>
                <th>Contract</th>
                <th>Username</th>
                <th>Password</th>
            </thead>
            <?php
            $counter = 1;
            while ($query2_data = mysqli_fetch_assoc($query2_result)) {
            ?>
                <tbody>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $query2_data['emp_id']; ?></td>
                    <td><?php echo $query2_data['name']; ?></td>
                    <td><?php echo $query2_data['father_name']; ?></td>
                    <td><?php echo $query2_data['cnic']; ?></td>
                    <td><?php echo $query2_data['nationality']; ?></td>
                    <td><?php echo $query2_data['DOB']; ?></td>
                    <td><?php echo $query2_data['blood_group']; ?></td>
                    <td><?php echo $query2_data['DOJ']; ?></td>
                    <td><?php echo $query2_data['rank']; ?></td>
                    <td><?php echo $query2_data['salary']; ?></td>
                    <td><?php echo $query2_data['contract']; ?></td>
                    <td><?php echo $query2_data['username']; ?></td>
                    <td><?php echo $query2_data['password']; ?></td>
                </tbody>
            <?php
                $counter++;
            }
            ?>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>