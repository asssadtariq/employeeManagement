<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Employees Attendance</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark fixed-top position-relative">
        <div class="container-fluid  d-flex justify-content-left w-100">
            <a class="navbar-brand fs-1 mx-2 " href="#">Codeza : Attendance</a>
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
                        <li> <a style="text-decoration:none; color:black;" href="emp_home.php"> Go to home page </a> </li>
                    </ul>
                </div>
            </div>
    </nav>

    <div class="emp-att">
        <div class="search-box my-2">
            <form action="">
                <div class="input-group mb-3" style="margin-right: 4px;">
                    <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Search Here ... " style="width: 990px;">
                    <button class="btn btn-dark btn-lg"> Search </button>
                </div>
            </form>
        </div>
        <div class="att-tab">
            <table class="table text-center">
                <thead class="table-dark">
                    <th style="text-align: left;"> # </th>
                    <th> Date </th>
                    <th> Attendance </th>
                </thead>
                <tbody>
                    <td style="text-align: left;"> 1 </td>
                    <td> 28/4/2021 </td>
                    <td> P </td>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>