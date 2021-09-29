<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

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
        </div>

      </div>
    </div>
  </nav>

  <!-- Modal -->
  <div class="modal fade" id="changepassword" tabindex="-1" aria-labelledby="changepasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changepassword">Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row mb-3">
              <label for="lastPassword" class="col-sm-2 col-form-label">Last Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="lastPassword">
              </div>
            </div>
            <div class="row mb-3">
              <label for="newPassword" class="col-sm-2 col-form-label">New Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control " id="newPassword">
              </div>
            </div>
            <button type="submit" class="btn btn-dark">Change Password</button>
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
      <img src="../Pics/umar.jpg" class="card-img-top" alt="">
      <div class="card-body">
        <h2 class="card-text text-center"> Employee Name </h2>
        <h2 class="card-text text-center"> Employee ID </h2>
      </div>
    </div>
    <div class="more-info text-dark w-50" style="margin-left: 30px; margin-top: 5px;">
      <h1>Employee Details</h1>
      <ul class="list-group my-5 fs-4">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Username :
          <span class="badge badge-primary badge-pill text-dark py-3">Info</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          CNIC :
          <span class="badge badge-primary badge-pill text-dark py-3">Info</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          DOB :
          <span class="badge badge-primary badge-pill text-dark py-3">Info</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          DOJ :
          <span class="badge badge-primary badge-pill text-dark py-3">Info</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Contract :
          <span class="badge badge-primary badge-pill text-dark py-3">Info</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Salary :
          <span class="badge badge-primary badge-pill text-dark py-3">Info</span>
        </li>
      </ul>
    </div>
  </div>

  <div class="more-details d-flex justify-content-center my-5 mx-5">
    <div class="card mx-5" style="width: 25rem; height: 20rem;">
      <div class="card-body">
        <h2 class="card-title">View Attendance</h2>
        <p class="card-text my-4"> Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="emp_att.php" class="card-link"> Click Here </a>
      </div>
    </div>

    <div class="card mx-5" style="width: 25rem; height: 20rem;">
      <div class="card-body">
        <h2 class="card-title">View Salary</h2>
        <p class="card-text my-4"> Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="emp_sal.php" class="card-link"> Click Here </a>
      </div>
    </div>

    <div class="card mx-5" style="width: 25rem; height: 20rem;">
      <div class="card-body">
        <h2 class="card-title">Request Leave</h2>
        <form action="">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Enter Reason</label>
            <textarea class="form-control my-1" id="exampleFormControlTextarea1" rows="3"></textarea>
            <input type="date" class="input-group">
          </div>
          <button class="btn btn-dark w-50 my-5 fs-5" onclick="req_submission()"> Send Request </button>
        </form>
      </div>
    </div>

  </div>

  <script src="../JS/employee.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>