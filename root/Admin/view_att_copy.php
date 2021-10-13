<?php
session_start();
require_once "../confi.php";

$user = $_SESSION['user_email'];
$query = "SELECT * FROM employees WHERE (activeStatus = '1')  ORDER BY emp_id ASC";
$query_result = mysqli_query($conn, $query);

$monthSelected = date('m');
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

    <script>
        

    </script>

</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top position-relative">
        <div class="container-fluid">
            <a class="navbar-brand fs-1 mx-1" href="#">Codeza - Attendance List</a>

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
        <div class="search-box my-2">
            <form action="" method="POST">
                <div class="input-group mb-3" style="margin-right: 4px;">
                    <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Search Here ... " style="width: 990px;" name="empAttInfo">
                    <button class="btn btn-dark btn-lg" name="searchEmpAtt"> Search </button>
                    <button class="btn btn-dark btn-lg mx-2" name="disAll"> Display All </button>
                </div>
            </form>

            <?php
            if (isset($_POST['searchEmpAtt'])) {
                unset($_POST['searchEmpAtt']);
                $search_val = $_POST['empAttInfo'];

                $query3 = "SELECT * FROM employees WHERE ('$search_val' = emp_id)";
                $query_result = mysqli_query($conn, $query3);
            }

            if (isset($_POST['disAll'])) {
                unset($_POST['disAll']);
                $query = "SELECT * FROM employees WHERE (activeStatus = '1')  ORDER BY emp_id ASC";
                $query_result = mysqli_query($conn, $query);
            }
            ?>


        </div>

        <div class="months-btn" style="margin-left: 100px; padding: 0px 30px;">
            <form method="POST">
                <button type="submit" class="btn btn-secondary btn-lg" name="jan" onclick="currentMonth()">January</button>
                <button type="submit" class="btn btn-secondary btn-lg" name="feb" onclick="currentMonth()">February</button>
                <button type="submit" class="btn btn-secondary btn-lg" name="mar" onclick="currentMonth()">March</button>
                <button type="submit" class="btn btn-secondary btn-lg" name="apr" onclick="currentMonth()">April</button>
                <button type="submit" class="btn btn-secondary btn-lg" name="may" onclick="currentMonth()">May</button>
                <button type="submit" class="btn btn-secondary btn-lg" name="jun" onclick="currentMonth()">June</button>
                <button type="submit" class="btn btn-secondary btn-lg" name="jul" onclick="currentMonth()">July</button>
                <button type="submit" class="btn btn-secondary btn-lg" name="aug" onclick="currentMonth()">August</button>
                <button type="submit" class="btn btn-secondary btn-lg" name="sep" onclick="currentMonth()">September</button>
                <button type="submit" class="btn btn-secondary btn-lg" name="oct" onclick="currentMonth()">October</button>
                <button type="submit" class="btn btn-secondary btn-lg" name="nov" onclick="currentMonth()">November</button>
                <button type="submit" class="btn btn-secondary btn-lg" name="dec" onclick="currentMonth()">December</button>
            </form>
        </div>

        <?php
        if (isset($_POST['jan'])) {
            $monthSelected = 1;
        }

        if (isset($_POST['feb'])) {
            $monthSelected = 2;
        }

        if (isset($_POST['mar'])) {
            $monthSelected = 3;
        }
        if (isset($_POST['apr'])) {
            $monthSelected = 4;
        }
        if (isset($_POST['may'])) {
            $monthSelected = 5;
        }
        if (isset($_POST['jun'])) {
            $monthSelected = 6;
        }
        if (isset($_POST['jul'])) {
            $monthSelected = 7;
        }
        if (isset($_POST['aug'])) {
            $monthSelected = 8;
        }
        if (isset($_POST['sep'])) {
            $monthSelected = 9;
        }
        if (isset($_POST['oct'])) {

            $monthSelected = 10;
        }
        if (isset($_POST['nov'])) {
            $monthSelected = 11;
        }
        if (isset($_POST['dec'])) {
            $monthSelected = 12;
        }
        ?>

        <table class="table my-3">
            <tr class="table-dark">
                <th rowspan="2">#</th>
                <th rowspan="2">Name</th>
                <th rowspan="2">Employee ID</th>
                <th colspan="31" class="text-center">Date</th>
            </tr>
            <tr class="table-dark">
                <?php
                $tDays = cal_days_in_month(CAL_GREGORIAN, $monthSelected, date('Y'));
                $daysCounter = 1;
                while ($daysCounter <= $tDays) {
                ?>
                    <td style="border-color: whitesmoke; border: 2px solid;"><?php echo $daysCounter; ?></td>
                <?php
                    $daysCounter++;
                }
                ?>
            </tr>
            <?php
            $counter = 1;
            while ($query_data = mysqli_fetch_assoc($query_result)) {
            ?>

                <tbody>
                    <td style="width: 100px;"><?php echo $counter; ?></td>
                    <td style="width: 250px;"><?php echo $query_data['name']; ?></td>
                    <td style="width: 180px;"><?php echo $query_data['emp_id']; ?></td>
                    <?php
                    $counter2 = 1;
                    $empId = $query_data['emp_id'];
                    while ($counter2 <= $tDays) {
                        $queryAttendance = "SELECT status FROM attendance WHERE (emp_id = '$empId' AND MONTH(att_date) = '$monthSelected' AND DAY(att_date) = '$counter2')";
                        $queryAttendanceResult = mysqli_query($conn, $queryAttendance);
                        $status = "-";
                        if (@mysqli_num_rows($queryAttendanceResult) >= 1) {
                            $queryAttendanceData = mysqli_fetch_assoc($queryAttendanceResult);
                            $status = $queryAttendanceData['status'];
                        }
                    ?>
                        <td style="border-color: whitesmoke; border: 2px solid;"><?php echo $status; ?></td>
                    <?php
                        $counter2++;
                    }
                    ?>
                </tbody>

            <?php
                $counter++;
            }
            ?>
        </table>
    </div>

    <script src="../JS/jQuery/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>