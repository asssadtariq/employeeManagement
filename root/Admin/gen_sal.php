<?php
session_start();
require_once "../confi.php";

$query = "SELECT * FROM employees WHERE(activeStatus = '1')";
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
    <title>Codeza - Employees Salary Generator</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top position-relative">
        <div class="container-fluid">
            <a class="navbar-brand fs-1 mx-1" href="#">Codeza - Employees Salary</a>

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
        <table class="table">
            <thead class="table-dark">
                <th>#</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Father Name</th>
                <th>CNIC</th>
                <th>DOJ</th>
                <th>Rank</th>
                <th>Contract</th>
                <th>Salary</th>
                <th>Bonus</th>
            </thead>
            <?php
            $counter = 1;
            while ($query_data = mysqli_fetch_assoc($query_result)) {
            ?>
                <form method="POST">
                    <tbody>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $query_data['emp_id']; ?></td>
                        <td><?php echo $query_data['name']; ?></td>
                        <td><?php echo $query_data['father_name']; ?></td>
                        <td><?php echo $query_data['cnic']; ?></td>
                        <td><?php echo $query_data['DOJ']; ?></td>
                        <td><?php echo $query_data['rank']; ?></td>
                        <td><?php echo $query_data['contract']; ?></td>
                        <td><?php echo $query_data['salary']; ?></td>
                        <td style="width: 250px;"><input type="number" name="newSal[]" value="0" class="input-group" placeholder="Enter Bonus Amount">
                            <input type="number" name="empID[]" hidden value="<?php echo $query_data['emp_id']; ?>">
                            <input type="number" name="empSal[]" hidden value="<?php echo $query_data['salary']; ?>">
                        </td>
                    </tbody>

                <?php
                $counter++;
            }
                ?>

        </table>
        <button class="btn btn-dark btn-lg w-100" type="submit" name="genSal" style="border-radius: 5px; font-size: 20px;"> Generate Salary</button>
        </form>

        <?php
        if (isset($_POST['genSal'])) {
            unset($_POST['genSal']);
            $total_emp = count($_POST['newSal']);
            $current_date = date('Y-m-d');
            for ($i = 0; $i < $total_emp; $i++) {
                $new = $_POST['newSal'][$i];
                $eid = $_POST['empID'][$i];
                $basic = $_POST['empSal'][$i];
                $total = $new + $basic;
                $query2 = "INSERT INTO salaries VALUES (NULL, '$eid', '$basic', '$total', '$current_date') ";
                mysqli_query($conn, $query2);
            }
        }

        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>