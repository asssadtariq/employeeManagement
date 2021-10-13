<?php
session_start();
require_once "../confi.php";

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Codeza - Add New Employee</title>
    <style>
        label {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top position-relative">
        <div class="container-fluid">
            <a class="navbar-brand fs-1 mx-1" href="#">Codeza - Add New Employee</a>

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

    <div class="add-new-emp" style="margin-left: 30px; margin-right: 50px; margin-top: 20px;">
        <form class="row g-3" method="POST">
            <div class="col-md-6">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputName" required name="empName">
            </div>

            <div class="col-md-6">
                <label for="inputFatherName" class="form-label">Father Name</label>
                <input type="text" class="form-control" id="inputFatherName" required name="empFname">
            </div>

            <div class="col-md-8">
                <label for="inputCNIC" class="form-label">CNIC</label>
                <input type="number" class="form-control" id="inputCNIC" required name="cnic">
            </div>

            <div class="col-md-4">
                <label for="inputNationality" class="form-label">Nationality</label>
                <input type="text" class="form-control" id="inputNationality" required name="nationality">
            </div>

            <div class="col-md-8">
                <label for="inputDOB" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="inputDOB" required name="dob">
            </div>

            <div class="col-md-4">
                <label for="inputState" class="form-label">Blood Group</label>
                <select id="inputState" class="form-select" required name="bloodgroup">
                    <option selected>Choose Blood Group</option>
                    <option value="A">A</option>
                    <option value="A-">A-</option>
                    <option value="A+">A+</option>
                    <option value="B">B</option>
                    <option value="B-">B-</option>
                    <option value="B+">B+</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="inputID" class="form-label">Employee ID</label>
                <input type="number" class="form-control" id="inputID" required name="empID">
            </div>

            <div class="col-md-4">
                <label for="inputRank" class="form-label">Rank</label>
                <input type="text" class="form-control" id="inputRank" required name="Rank">
            </div>

            <div class="col-md-4">
                <label for="inputSal" class="form-label">Salary</label>
                <input type="number" class="form-control" id="inputSal" required name="sal">
            </div>

            <div class="col-md-6">
                <label for="inputDOJ" class="form-label">Date of Joining</label>
                <input type="date" class="form-control" id="inputDOJ" required name="doj">
            </div>

            <div class="col-md-6">
                <label for="inputContract" class="form-label">Contract</label>
                <input type="date" class="form-control" id="inputContract" required name="contract">
            </div>

            <div class="col-md-6">
                <label for="inputUN" class="form-label">Username</label>
                <input type="email" class="form-control" id="inputUN" required name="username">
            </div>

            <div class="col-md-6">
                <label for="inputPas" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPas" required name="password">
            </div>

            <div class="col-md-2">
                <label for="inputPhoto" class="form-label">Employee Photo</label>
                <input type="file" class="form-control" id="inputPhoto" required name="pic">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-dark btn-lg w-100 my-2" name="addRecord">Add Record</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>

<?php
if (isset($_POST['addRecord'])) {
    unset($_POST['addRecord']);

    $empName = $_POST['empName'];
    $empFname = $_POST['empFname'];
    $cnic = $_POST['cnic'];
    $nationality = $_POST['nationality'];
    $dob = $_POST['dob'];
    $bloodgroup = $_POST['bloodgroup'];
    $doj = $_POST['doj'];
    $empID = $_POST['empID'];
    $Rank = $_POST['Rank'];
    $sal = $_POST['sal'];
    $contract = $_POST['contract'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pic = $_POST['pic'];

    $query = "INSERT INTO employees VALUES('$empName', '$empFname', '$cnic', '$nationality', '$dob', '$bloodgroup', '$doj', '$empID', '$Rank', '$sal', '$contract', '$username', '$password', '$pic', '1')";
    mysqli_query($conn, $query);
}

?>