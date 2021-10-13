<?php
session_start();
require_once "../confi.php";
class Admin
{
    var $name;
    var $father_name;
    var $cnic;
    var $nationality;
    var $dob;
    var $blood_group;
    var $adminID;
    var $userName;
    var $password;
    var $pic;
}

$user = $_SESSION['user_email'];
$query = "SELECT * FROM admins WHERE(username = '$user')";
$query_result = mysqli_query($conn, $query);
$query_data = mysqli_fetch_assoc($query_result);
$admin = new Admin();

$admin->name = $query_data['name'];
$admin->adminID = $query_data['admin_id'];
$admin->userName = $query_data['username'];
$admin->cnic = $query_data['cnic'];
$admin->dob = $query_data['DOB'];
$admin->password = $query_data['password'];
$admin->pic = $query_data['pic_path'];
$admin->blood_group = $query_data['blood_group'];

$query3 = "SELECT count(emp_id) AS tot_emp FROM employees";
$query3_result = mysqli_query($conn, $query3);
$query3_data = mysqli_fetch_assoc($query3_result);
$total_emp = $query3_data['tot_emp'];

$query4 = "SELECT sum(new_sal) AS tot_sal FROM salaries";
$query4_result = mysqli_query($conn, $query4);
$query4_data = mysqli_fetch_assoc($query4_result);
$total_sal = $query4_data['tot_sal'];

$salaries = array(
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
    6 => 0,
    7 => 0,
    8 => 0,
    9 => 0,
    10 => 0,
    11 => 0,
    12 => 0,
);

$expenses = array(
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
    6 => 0,
    7 => 0,
    8 => 0,
    9 => 0,
    10 => 0,
    11 => 0,
    12 => 0,
);

for ($i = 1; $i <= 12; $i++) {
    $query = "SELECT SUM(new_sal) AS tSal FROM salaries WHERE(MONTH(sal_date) = $i)";
    $query_result = mysqli_query($conn, $query);
    if (@mysqli_num_rows($query_result) >= 1) {
        $query_date = mysqli_fetch_assoc($query_result);
        $salaries[$i] = $query_date['tSal'];
    }
}

for ($i = 1; $i <= 12; $i++) {
    $query2 = "SELECT SUM(amount) AS totalAmount FROM expenses WHERE(MONTH(exp_date) = $i)";
    $query2_result = mysqli_query($conn, $query2);
    if (@mysqli_num_rows($query2_result) >= 1) {
        $query2_date = mysqli_fetch_assoc($query2_result);
        $expenses[$i] = $query2_date['totalAmount'];
    }
}

$queryExpTypeGroup = "SELECT SUM(amount) AS totalAmount, expense_name FROM expenses GROUP BY expense_name";
$queryExpTypeGroupResult = mysqli_query($conn, $queryExpTypeGroup);

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Months', 'Salaries', 'Expenses'],
                ['Jan', <?php echo $salaries[1] ?>, <?php echo $expenses[1] ?>],
                ['Feb', <?php echo $salaries[2] ?>, <?php echo $expenses[2] ?>],
                ['Mar', <?php echo $salaries[3] ?>, <?php echo $expenses[3] ?>],
                ['Apr', <?php echo $salaries[4] ?>, <?php echo $expenses[4] ?>],
                ['May', <?php echo $salaries[5] ?>, <?php echo $expenses[5] ?>],
                ['Jun', <?php echo $salaries[6] ?>, <?php echo $expenses[6] ?>],
                ['Jul', <?php echo $salaries[7] ?>, <?php echo $expenses[7] ?>],
                ['Aug', <?php echo $salaries[8] ?>, <?php echo $expenses[8] ?>],
                ['Sep', <?php echo $salaries[9] ?>, <?php echo $expenses[9] ?>],
                ['Oct', <?php echo $salaries[10] ?>, <?php echo $expenses[10] ?>],
                ['Nov', <?php echo $salaries[11] ?>, <?php echo $expenses[11] ?>],
                ['Dec', <?php echo $salaries[12] ?>, <?php echo $expenses[12] ?>]
            ]);

            var options = {
                chart: {
                    title: 'Codeza - Expenses Detail',
                    subtitle: 'Salaries and Expenses Statistics',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Expense Name', 'Expense Amount'],
                <?php while ($queryETGD = mysqli_fetch_assoc($queryExpTypeGroupResult)) {
                ?>['<?php echo $queryETGD['expense_name']; ?>', <?php echo $queryETGD['totalAmount']; ?>],
                <?php }
                ?>

            ]);

            var options = {
                title: 'My Daily Activities'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

    <script>
        function updateAtt() {
            var empID = $('#uppEmpID').val();
            var date = $('#empAttDate').val();
            var status = $('#empAtt').val();

            $.ajax({
                url: "queries_ajax.php",
                type: "POST",
                data: {
                    empid: empID,
                    date: date,
                    att: status
                },

                success: function(data) {
                    alert(data);
                    location.reload();
                }
            });

        }

        function deleteAtt() {
            var empID = $('#delEmpID').val();
            var attDate = $('#delAttDate').val();

            $.ajax({
                url: "queries_ajax.php",
                type: "POST",
                data: {
                    empid: empID,
                    attdate: attDate
                },

                success: function(data) {
                    alert(data);
                    location.reload();
                }
            });

        }

        function deleteEmp() {
            var empID = $('#delEmpID2').val();
            console.log("empID " + empID);
            $.ajax({
                url: "queries_ajax.php",
                type: "POST",
                data: {
                    empID: empID,
                    empDelStatus: "1"
                },

                success: function(data) {
                    alert(data);
                    location.reload();
                }
            });
        }

        function addExpData() {
            var expName = $('#expNameID').val();
            var expAmount = $('#expAmountID').val();
            var expDate = $('#expDateID').val();

            $.ajax({
                type: 'post',
                url: 'add_expenses.php',
                data: {
                    name: expName,
                    amount: expAmount,
                    date: expDate
                },
                success: function(data) {
                    alert(data);
                    location.reload();
                }
            });

        }

        function updateExp() {
            var expID = $('#expID2').val();
            var expName = $('#expName2').val();
            var expAmount = $('#expAmount2').val();
            var expDate = $('#expDate2').val();

            $.ajax({
                type: 'post',
                url: 'add_expenses.php',
                data: {
                    uppID: expID,
                    uppName: expName,
                    uppAmount: expAmount,
                    uppDate: expDate
                },
                success: function(data) {
                    alert(data);
                    location.reload();
                }
            });

        }

        function deleteExp() {
            var expID = $('#expIDdel').val();
            $.ajax({
                type: 'post',
                url: 'add_expenses.php',
                data: {
                    delID: expID,
                },
                success: function(data) {
                    alert(data);
                    location.reload();
                }
            });

        }
    </script>

    <style>
        .cards-cards ul li {
            text-align: center;
        }

        .cards-cards ul li a {
            list-style: none;
            text-decoration: none;
            color: black;
            font-size: 20px;
        }

        .cards-cards ul li a:hover {
            color: blue;
        }

        #admin_info li span {
            font-size: 25px;
        }
    </style>

    <title>Codeza - Admin</title>
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
                            <a data-bs-toggle="modal" data-bs-target="#changepassword" style="text-decoration:none; color:black;" href="#">Change Password</a>
                        </li>
                    </ul>
                    <ul class="fs-5" style="list-style: none;">
                        <li>
                            <a style="text-decoration:none; color:black;" href="leaves_req.php">See Leave Requests</a>
                        </li>
                    </ul>

                    <ul class="fs-5" style="list-style: none;">
                        <li>
                            <a style="text-decoration:none; color:black;" href="gen_sal.php">Generate Salary</a>
                        </li>
                    </ul>

                    <ul class="fs-5" style="list-style: none;">
                        <li> <a style="text-decoration:none; color:black;" href="../logout.php">Log out</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="admin-info d-flex justify-content-center">
        <div class="card mx-5 my-2" style="width: 18rem; border-radius: 20px;">
            <img src="<?php echo $admin->pic ?>" class="card-img-top" style="border-radius: 20px; height: 400px; width: 286px;" alt="...">
            <ul class="list-group list-group-flush text-center fs-4">
                <li class="list-group-item"><?php echo $admin->name; ?></li>
                <li class="list-group-item"> <?php echo $admin->adminID; ?> </li>
            </ul>
        </div>

        <div class="more-info w-50">
            <div class="more-info text-dark" style="margin-left: 30px; margin-top: 5px;">
                <h1>Admin Details</h1>
                <ul class="list-group my-5 fs-4" id="admin_info">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Username :
                        <span class="badge badge-primary badge-pill text-dark py-3"><?php echo $admin->userName; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        CNIC :
                        <span class="badge badge-primary badge-pill text-dark py-3"><?php echo $admin->cnic; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        DOB :
                        <span class="badge badge-primary badge-pill text-dark py-3"><?php echo $admin->dob; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Blood Group :
                        <span class="badge badge-primary badge-pill text-dark py-3"><?php echo $admin->blood_group; ?></span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="org-info d-flex justify-content-end w-25 my-2">
            <table class="table" style="width: 300px; margin-left: 50px; height: 100px;">
                <thead class="table-active">
                    <tr>
                        <th>Total Employees</th>
                        <th>Total Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><?php echo $total_emp; ?></th>
                        <th><?php echo $total_sal; ?></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="cards-cards d-flex justify-content-center my-5">

        <div class="card mx-5" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title text-center fs-1">Attendance</h2>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="mark_att.php"> <button class="btn btn-dark w-100"> Mark Attendance </button></a></li>
                <li class="list-group-item"><a href="view_att.php"> <button class="btn btn-dark w-100"> View Attendance </button></a></li>
                <li class="list-group-item"><a href="#" data-bs-toggle="modal" data-bs-target="#updateAtt"> <button class="btn btn-dark w-100">Update Attendance </button></a></li>
                <li class="list-group-item"><a href="#" data-bs-toggle="modal" data-bs-target="#delAtt"> <button class="btn btn-dark w-100">Delete Attendance </button></a></li>
            </ul>
        </div>

        <div class="card mx-5" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title text-center fs-1">Employee</h2>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="add_emp.php"> <button class="btn btn-dark w-100"> Add Employee </button></a></li>
                <li class="list-group-item"><a href="view_emp.php"> <button class="btn btn-dark w-100">View Employee </button></a></li>
                <li class="list-group-item"><a href="#" data-bs-toggle="modal" data-bs-target="#updateEmp"> <button class="btn btn-dark w-100">Update Employee </button></a></li>
                <li class="list-group-item"><a href="#" data-bs-toggle="modal" data-bs-target="#delEmp"> <button class="btn btn-dark w-100">Delete Employee </button></a></li>
            </ul>
        </div>


        <div class="card mx-5" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title text-center fs-1">Expenses</h2>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="#" data-bs-toggle="modal" data-bs-target="#addExp"> <button class="btn btn-dark w-100">Add Expenses </button></a></li>
                <li class="list-group-item"><a href="view_exp.php"> <button class="btn btn-dark w-100">View Expenses </button></a></li>
                <li class="list-group-item"><a href="#" data-bs-toggle="modal" data-bs-target="#uppExp"> <button class="btn btn-dark w-100">Update Expenses </button></a></li>
                <li class="list-group-item"><a href="#" data-bs-toggle="modal" data-bs-target="#delExp"> <button class="btn btn-dark w-100">Delete Expenses </button></a></li>
            </ul>
        </div>

    </div>

    <div class="grpahs w-100 d-flex justify-content-center my-5 mx-5">
        <div id="columnchart_material" style="width: 900px; height: 600px;"></div>
        <div id="piechart" style="width: 900px; height: 500px;"></div>
    </div>


    <!-- Modal - Change Password-->
    <div class="modal fade" id="changepassword" tabindex="-1" aria-labelledby="changepasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changepassword">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="row mb-3">
                            <label for="lastPassword" class="col-sm-2 col-form-label">Last Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="lastPassword" name="lastPas">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="newPassword" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control " id="newPassword" name="newPas">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark" name="changePas">Change Password</button>
                    </form>
                </div>

                <?php
                if (isset($_POST['changePas'])) {
                    unset($_POST['changePas']);
                    $last = $_POST['lastPas'];
                    $new = $_POST['newPas'];
                    $change_status = false;
                    if ($last == $admin->password) {
                        $query2 = "UPDATE admins SET password = '$new' WHERE (admin_id = '$admin->adminID')";
                        $query2_result = mysqli_query($conn, $query2);
                        $change_status = true;
                    }
                }
                ?>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Update Attendance -->
    <div class="modal fade" id="updateAtt" tabindex="-1" aria-labelledby="updateAttModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateAtt">Update Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <label for="empid" class="col-sm-2 col-form-label w-25">Employee ID : </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control " id="uppEmpID" name="empid">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="att_date" class="col-sm-2 col-form-label">Date : </label>
                            <div class="col-sm-10">
                                <input type="Date" class="form-control" id="empAttDate" name="empAttDate">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="empid" class="col-sm-2 col-form-label">Status </label>
                            <div class="col-sm-10">
                                <select name="att" id="empAtt" class="form-select">
                                    <option value="P" selected>Present</option>
                                    <option value="L">Leave</option>
                                    <option value="A">Absent</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" class="btn btn-dark my-2" id="uppAtt" onclick="updateAtt()">Update Attendance</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Delete Attendance -->
    <div class="modal fade" id="delAtt" tabindex="-1" aria-labelledby="delAttModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delAttAtt">Delete Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <label for="empid" class="col-sm-2 col-form-label w-25">Employee Id : </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="delEmpID" name="empid">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="att_date" class="col-sm-2 col-form-label">Date : </label>
                            <div class="col-sm-10">
                                <input type="Date" class="form-control" id="delAttDate" name="attdate">
                            </div>
                        </div>
                        <button type="button" class="btn btn-dark my-3" name="delAtt" onclick="deleteAtt()">Delete Attendance</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Update Employee -->
    <div class="modal fade" id="updateEmp" tabindex="-1" aria-labelledby="updateEmpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateEmp">Update Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="update_emp.php" method="POST">
                        <div class="row mb-3">
                            <label for="empid" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-11">
                                <input type="number" name="empID" class="form-control" id="empid" placeholder="Enter Emloyee ID">
                            </div>
                        </div>

                        <button type="submit" name="checkID" class="btn btn-dark my-1">Update Employee</button>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Employee -->
    <div class="modal fade" id="delEmp" tabindex="-1" aria-labelledby="delEmpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delEmp">Delete Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <label for="empid" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-11">
                                <input type="number" name="delEmpID2" id="delEmpID2" class="form-control" placeholder="Enter Emloyee ID">
                            </div>
                        </div>

                        <button type="button" id="delEmp" class="btn btn-dark my-1" onclick="deleteEmp()">Delete Record</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Add Expanses -->
    <div class="modal fade" id="addExp" tabindex="-1" aria-labelledby="addExpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addExp">Add Expanses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addExpForm">
                        <div class="row mb-3">
                            <label for="empid" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-11">
                                <input type="text" name="expName" class="form-control" id="expNameID" placeholder="Enter Expense Name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="empid" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-11">
                                <input type="number" name="expAmount" class="form-control" id="expAmountID" placeholder="Enter Expanse Amount">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="empid" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-11">
                                <input type="date" name="expDate" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="expDateID">
                            </div>
                        </div>

                        <button type="button" class="btn btn-dark my-1" id="AddExpBtn" name="AddExp" onclick="addExpData()">Add Expense</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Expanses -->
    <div class="modal fade" id="uppExp" tabindex="-1" aria-labelledby="uppExpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uppExp">Update Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-sm-11">
                                <input type="text" class="form-control" id="expID2" name="expID2" placeholder="Enter Expense ID">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-11">
                                <input type="text" class="form-control" id="expName2" name="expName2" placeholder="Enter Expense Name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-11">
                                <input type="number" name="expAmount2" class="form-control" id="expAmount2" placeholder="Enter Expanse Amount">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-11">
                                <input type="date" name="expDate2" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="expDate2" placeholder="Enter Date">
                            </div>
                        </div>
                        <button type="button" id="uppExp" name="uppExp" class="btn btn-dark my-1" onclick="updateExp()">Update Record</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Delete Expanses -->
    <div class="modal fade" id="delExp" tabindex="-1" aria-labelledby="delExpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delExp">Delete Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <label for="empid" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-11">
                                <input type="number" name="expIDdel" class="form-control" id="expIDdel" placeholder="Enter Expense ID">
                            </div>
                        </div>

                        <button type="button" id="delExp" class="btn btn-dark my-1" onclick="deleteExp()">Delete Expense</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="../JS/jQuery/jquery-3.6.0.js"></script>
</body>

</html>

<?php

if (isset($_POST['delExp'])) {
    unset($_POST['delExp']);
    $exp_id = $_POST['expIDdel'];

    $query_ExpDel = "DELETE FROM expenses WHERE (exp_id = '$exp_id')";
    mysqli_query($conn, $query_ExpDel);
    if (mysqli_affected_rows($conn) == 1) {
        echo '
            <script type="text/JavaScript">
                alert("Expenses Deleted Successfully"); 
            </script>
        ';
    } else {
        echo '
            <script type="text/JavaScript">
                alert("Expenses Deletion Failed"); 
            </script>
        ';
    }
}

?>