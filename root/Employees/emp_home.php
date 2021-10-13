<?php
session_start();
require_once "../confi.php";

class Employee
{
  var $name;
  var $father_name;
  var $cnic;
  var $nationality;
  var $dob;
  var $blood_group;
  var $doj;
  var $empID;
  var $rank;
  var $salary;
  var $contract;
  var $userName;
  var $password;
  var $pic;
}

$user = $_SESSION['user_email'];
$query = "SELECT * FROM employees WHERE ('$user' = username)";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

$emp1 = new Employee();
$emp1->name = $data['name'];
$emp1->empID = $data['emp_id'];
$emp1->userName = $data['username'];
$emp1->cnic = $data['cnic'];
$emp1->dob = $data['DOB'];
$emp1->doj = $data['DOJ'];
$emp1->contract = $data['contract'];
$emp1->salary = $data['salary'];
$emp1->pic = $data['pic_path'];
$emp1->password = $data['password'];

$id = $data['emp_id'];
$_SESSION['current_user'] = $id;

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <script>
    function sendRequest() {
      var reason = $('#reason').val();
      var date = $('#reqDate').val();

      $.ajax ({
        url: "send_req.php",
        method: "POST",
        data: {empReason: reason, reqDate: date},
        success: function (data) {
          alert(data);
        }
      }); 


    }
  </script>

  <style>
    #employee_info li span {
      font-size: 25px;
    }
  </style>
  <title>Header</title>
</head>

<body>

  <nav class="navbar navbar-dark bg-dark fixed-top position-relative">
    <div class="container-fluid">
      <a class="navbar-brand fs-1 mx-5" href="#">Codeza : Employees</a>

      <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Settings</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
          <ul class="fs-5" style="list-style: none;">
            <li> <a data-bs-toggle="modal" data-bs-target="#changepassword" style="text-decoration:none; color:black;" href="#">Change Password</a> </li>
          </ul>
          <ul class="fs-5" style="list-style: none;">
            <li> <a style="text-decoration:none; color:black;" href="../logout.php">Log out</a> </li>
          </ul>
        </div>

      </div>
    </div>
  </nav>

  <!-- Modal Change Password -->
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
                <input type="password" class="form-control" id="lastPassword" name="lastPass">
              </div>
            </div>
            <div class="row mb-3">
              <label for="newPassword" class="col-sm-2 col-form-label">New Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control " id="newPassword" name="newPass">
              </div>
            </div>
            <button type="submit" class="btn btn-dark" name="changePass">Change Password</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

  <div class="employee-info d-flex justify-content-center">
    <div class="card" style="width: 20rem; margin-top: 10px; margin-left: 10px;">
      <img src="<?php echo "../Pics/" . $emp1->pic ?>" class="card-img-top" style="height: 400px; width: 318px;">
      <div class="card-body my-3">
        <h2 class="card-text text-center"> <?php echo $emp1->name ?> </h2>
        <br>
        <h2 class="card-text text-center"> <?php echo $emp1->empID ?> </h2>
      </div>
    </div>
    <div class="more-info text-dark w-50" style="margin-left: 30px; margin-top: 5px;">
      <h1>Employee Details</h1>
      <ul class="list-group my-5 fs-4" id="employee_info">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Username :
          <span class="badge badge-primary badge-pill text-dark py-3"><?php echo $emp1->userName ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          CNIC :
          <span class="badge badge-primary badge-pill text-dark py-3"><?php echo $emp1->cnic ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          DOB :
          <span class="badge badge-primary badge-pill text-dark py-3"><?php echo $emp1->dob ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          DOJ :
          <span class="badge badge-primary badge-pill text-dark py-3"><?php echo $emp1->doj ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Contract :
          <span class="badge badge-primary badge-pill text-dark py-3"><?php echo $emp1->contract ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Salary :
          <span class="badge badge-primary badge-pill text-dark py-3"><?php echo $emp1->salary ?></span>
        </li>
      </ul>
    </div>
  </div>

  <div class="more-details d-flex justify-content-center my-5 mx-5">
    <div class="card mx-5" style="width: 25rem; height: 20rem;">
      <div class="card-body">
        <h2 class="card-title text-center mb-3">View Attendance</h2>
        <p>Click the following button to see employee attendance record</p>
        <a href="emp_att.php" class="card-link text-decoration-none text-light  h-50" style="display: flex; align-items: flex-end;">
          <button class="btn btn-dark w-100 fs-5 d-flex justify-content-center"> See Attendance Details </button>
        </a>
      </div>
    </div>

    <div class="card mx-5" style="width: 25rem; height: 20rem;">
      <div class="card-body">
        <h2 class="card-title text-center mb-3">View Salary</h2>
        <p>Click the following button to see employee salary record</p>
        <a href="emp_sal.php" class="card-link text-decoration-none text-light h-50" style="display: flex; align-items: flex-end;">
          <button class="btn btn-dark w-100 fs-5 d-flex justify-content-center"> See Salary Details </button>
        </a>
      </div>
    </div>

    <div class="card mx-5" style="width: 25rem; height: 20rem;">
      <div class="card-body">
        <h2 class="card-title text-center mb-3">Request Leave</h2>
        <form>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Enter Reason</label>
            <textarea class="form-control my-1" id="reason" rows="3" name="reason"></textarea>
            <input type="date" id="reqDate" class="input-group" name="reqDate" value="<?php echo Date('Y-m-d');?>">
          </div>
          <button type="button" id="sendReq" class="btn btn-dark w-100 my-5 fs-5 d-flex justify-content-center" onclick="sendRequest()"> Send Request </button>
        </form>

      </div>
    </div>

  </div>

  <script src="../JS/employee.js"></script>
  <script src="../JS/jQuery/jquery-3.6.0.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>

<?php

if (isset($_POST['changePass'])) {
  unset($_POST['changePass']);
  if ($_POST['lastPass'] == $emp1->password) {
    $newPassword = $_POST['newPass'];
    $query_changePasswod = "UPDATE employees SET password = '$newPassword' WHERE ('$user' = username)";
    $qCP_result = mysqli_query($conn, $query_changePasswod);
  }
}

// if (isset($_POST['sendReq']) && (isset($_POST['reason']) && isset($_POST['reqDate']))) {
//   unset($_POST['sendReq']);
//   $rea = $_POST['reason'];
//   $rDate = $_POST['reqDate'];
//   $query2 = "INSERT INTO leave_requests VALUES(NULL, '$id', '$rea', '$rDate', '0')";
//   $query_result = mysqli_query($conn, $query2);
//   unset($_POST['reason']);
//   unset($_POST['reqDate']);
// }

?>