<?php
session_start();
require_once "../confi.php";

$user = $_SESSION['user_email'];
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
        function currentMonth(monthNum) {
            $.ajax({
                url: "queries_ajax.php",
                type: "POST",
                data: {
                    currMon: monthNum
                },
                success: function(data) {
                    $('#attTable').html(data);
                }
            });
        }
    </script>

</head>

<body onload="currentMonth(10)">
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

        <div class="months-btn" style="margin-left: 50px; padding: 0px 30px;">
            <button class="btn btn-secondary btn-lg" onclick="currentMonth(1)">January</button>
            <button class="btn btn-secondary btn-lg" onclick="currentMonth(2)">February</button>
            <button class="btn btn-secondary btn-lg" onclick="currentMonth(3)">March</button>
            <button class="btn btn-secondary btn-lg" onclick="currentMonth(4)">April</button>
            <button class="btn btn-secondary btn-lg" onclick="currentMonth(5)">May</button>
            <button class="btn btn-secondary btn-lg" onclick="currentMonth(6)">June</button>
            <button class="btn btn-secondary btn-lg" onclick="currentMonth(7)">July</button>
            <button class="btn btn-secondary btn-lg" onclick="currentMonth(8)">August</button>
            <button class="btn btn-secondary btn-lg" onclick="currentMonth(9)">September</button>
            <button class="btn btn-secondary btn-lg" onclick="currentMonth(10)">October</button>
            <button class="btn btn-secondary btn-lg" onclick="currentMonth(11)">November</button>
            <button class="btn btn-secondary btn-lg" onclick="currentMonth(12)">December</button>
        </div>

        <div id="attTable">

        </div>

    </div>

    <script src="../JS/jQuery/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>