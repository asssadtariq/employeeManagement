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
    <title>Mark Attendance</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top position-relative">
        <div class="container-fluid">
            <a class="navbar-brand fs-1 mx-1" href="#">Codeza</a>

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

    <div class="att-table my-4">
        <h1 class="fs-2 text-center my-4">Attendance List</h1>
        <table class="table">
            <thead class="table-dark">
                <th>#</th>
                <th>Name</th>
                <th>Employee ID</th>
                <th>Date</th>
                <th>Salary</th>
                <th>Attendance</th>
            </thead>
            <?php
            $counter = 1;
            while ($query_data = mysqli_fetch_assoc($query_result)) {
            ?>
                <tbody>
                    <td style="width: 100px;"><?php echo $counter; ?></td>
                    <td style="width: 250px;"><?php echo $query_data['name']; ?></td>
                    <td style="width: 250px;"><?php echo $query_data['emp_id']; ?></td>
                    <td style="width: 180px;"> <?php echo date('Y-m-d'); ?> </td>
                    <td style="width: 250px;"><?php echo $query_data['salary']; ?></td>
                    <td style="width: 350px;">
                        <form action="" method="POST">
                            <input type="text" class="input-group w-50" name="empID[]" value="<?php echo $query_data['emp_id'] ?>" hidden/>
                            <select name="attendance_check[]" id="att_check" class="form-select w-75">
                                <option value="P" selected>Present</option>
                                <option value="A">Absent</option>
                                <option value="L">Leave</option>
                            </select>
                    </td>
                </tbody>

            <?php
                $counter++;
            } ?>
        </table>

        <button class="btn btn-dark w-100" name="markAtt"> Mark Attendance </button>
        </form>

        <?php
        if (isset($_POST['markAtt'])) {
            unset($_POST['markAtt']);
            $total_emp = count($_POST['attendance_check']);
            $current_date = date('Y-m-d');
            for ($i = 0; $i < $total_emp; $i++) {
                $status = $_POST['attendance_check'][$i];
                $eid = $_POST['empID'][$i];
                $query2 = "REPLACE INTO attendance (att_id, emp_id, att_date, status) VALUES (NULL, '$eid', '$current_date', '$status') ";
                mysqli_query($conn, $query2);
            }
        }
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>