<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
        .cards-cards ul li {
            text-align: center;
        }

        .cards-cards ul li a {
            list-style: none;
            text-decoration: none;
            color: black;
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
                    <ul style="list-style: none;">
                        <li> <button class="btn btn-dark">
                                <a data-bs-toggle="modal" data-bs-target="#changepassword" style="text-decoration:none; color:whitesmoke;" href="#">Change Password</a>
                            </button>
                        </li>
                        <li>
                            <button class="btn btn-dark my-3">
                                <a style="text-decoration:none; color:whitesmoke;" href="#">See Leave Requests</a>
                            </button>
                        </li>

                        <li>
                            <button class="btn btn-dark" style="margin-right: 30px;">
                                <a style="text-decoration:none; color:whitesmoke;" href="#">Generate Salary</a>
                            </button>
                        </li>
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

    <div class="admin-info d-flex justify-content-center">
        <div class="card mx-5 my-2" style="width: 18rem; border-radius: 20px;">
            <img src="../Pics/umar.jpg" class="card-img-top" style="border-radius: 20px;" alt="...">
            <ul class="list-group list-group-flush text-center fs-4">
                <li class="list-group-item">Admin Name</li>
                <li class="list-group-item">Admin ID</li>
            </ul>
        </div>

        <div class="more-info w-50">
            <div class="more-info text-dark" style="margin-left: 30px; margin-top: 5px;">
                <h1>Admin Details</h1>
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
                        <th>100</th>
                        <th>25000</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="cards-cards d-flex justify-content-center my-5">

        <div class="card mx-5" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title text-center">Attendance</h2>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="#"> Mark Attendance</a></li>
                <li class="list-group-item"><a href="#">View Attendance</a></li>
                <li class="list-group-item"><a href="#">Update Attendance</a></li>
                <li class="list-group-item"><a href="#">Delete Attendance</a></li>
            </ul>
        </div>

        <div class="card mx-5" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title text-center">Employee</h2>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="#">Mark Employee</a></li>
                <li class="list-group-item"><a href="#">View Employee</a></li>
                <li class="list-group-item"><a href="#">Update Employee</a></li>
                <li class="list-group-item"><a href="#">Delete Employee</a></li>
            </ul>
        </div>


        <div class="card mx-5" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title text-center">Expenses</h2>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="#">Mark Expenses</a></li>
                <li class="list-group-item"><a href="#">View Expenses</a></li>
                <li class="list-group-item"><a href="#">Update Expenses</a></li>
                <li class="list-group-item"><a href="#">Delete Expenses</a></li>
            </ul>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>