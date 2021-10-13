<?php
session_start();
require_once "../confi.php";

$id = $_POST['empID'];

$query = "SELECT * FROM employees WHERE ('$id' = emp_id AND activeStatus = '1')";
$query_result = mysqli_query($conn, $query);
$found = false;
if (@mysqli_num_rows($query_result) >= 1) {
    $found = true;
}

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
            <a class="navbar-brand fs-1 mx-1" href="#">Codeza - Update Employee</a>

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
    <?php
    if ($found) {
        $query_data = mysqli_fetch_assoc($query_result)
    ?>
        <div class="add-new-emp" style="margin-left: 30px; margin-right: 50px; margin-top: 20px;">
            <form class="row g-3" method="POST">
                <div class="col-md-6">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="inputName" required name="empName" value="<?php echo $query_data['name']; ?>">
                </div>

                <div class="col-md-6">
                    <label for="inputFatherName" class="form-label">Father Name</label>
                    <input type="text" class="form-control" id="inputFatherName" required name="empFname" value="<?php echo $query_data['father_name']; ?>">
                </div>

                <div class="col-md-8">
                    <label for="inputCNIC" class="form-label">CNIC</label>
                    <input type="text" class="form-control" id="inputCNIC" required name="cnic" value="<?php echo $query_data['cnic']; ?>">
                </div>

                <div class="col-md-4">
                    <label for="inputNationality" class="form-label">Nationality</label>
                    <input type="text" class="form-control" id="inputNationality" required name="nationality" value="<?php echo $query_data['nationality']; ?>">
                </div>

                <div class="col-md-8">
                    <label for="inputDOB" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="inputDOB" required name="dob" value="<?php echo $query_data['DOB']; ?>">
                </div>

                <div class="col-md-4">
                    <label for="inputState" class="form-label">Blood Group</label>
                    <select id="inputState" class="form-select" required name="bloodgroup">
                        <option selected><?php echo $query_data['blood_group']; ?></option>
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
                    <input type="number" class="form-control" id="inputID" required name="empID" value="<?php echo $query_data['emp_id']; ?>">
                </div>

                <div class="col-md-4">
                    <label for="inputRank" class="form-label">Rank</label>
                    <input type="text" class="form-control" id="inputRank" required name="Rank" value="<?php echo $query_data['rank']; ?>">
                </div>

                <div class="col-md-4">
                    <label for="inputSal" class="form-label">Salary</label>
                    <input type="number" class="form-control" id="inputSal" required name="sal" value="<?php echo $query_data['salary']; ?>">
                </div>

                <div class="col-md-6">
                    <label for="inputDOJ" class="form-label">Date of Joining</label>
                    <input type="date" class="form-control" id="inputDOJ" required name="doj" value="<?php echo $query_data['DOJ']; ?>">
                </div>

                <div class="col-md-6">
                    <label for="inputContract" class="form-label">Contract</label>
                    <input type="date" class="form-control" id="inputContract" required name="contract" value="<?php echo $query_data['contract']; ?>">
                </div>

                <div class="col-md-6">
                    <label for="inputUN" class="form-label">Username</label>
                    <input type="email" class="form-control" id="inputUN" required name="username" value="<?php echo $query_data['username']; ?>">
                </div>

                <div class="col-md-6">
                    <label for="inputPas" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPas" required name="password" value="<?php echo $query_data['password']; ?>">
                </div>

                <div class="col-12 my-5">
                    <button type="submit" class="btn btn-dark btn-lg w-100 my-2" name="updateRecord">Update Record</button>
                </div>
            </form>
        </div>

    <?php } else { ?>

        <div class="alert alert-danger text-center" role="alert">
            Record Not Found !!! <br> <a href="admin_home.php" class="alert-link">Click Here</a>.
        </div>

    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>

<?php


if (@isset($_POST['updateRecord'])) {
    unset($_POST['updateRecord']);
    $empName = $_POST['empName'];
    $empFname = $_POST['empFname'];
    $cnic = $_POST['cnic'];
    $nationality = $_POST['nationality'];
    $dob = date('Y-m-d');
    $bloodgroup = $_POST['bloodgroup'];
    $doj = $_POST['doj'];
    $empID = $_POST['empID'];
    $Rank = $_POST['Rank'];
    $sal = $_POST['sal'];
    $contract = $_POST['contract'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "UPDATE employees SET 
    name = '$empName', 
    father_name = '$empFname', 
    cnic = '$cnic', 
    nationality = '$nationality', 
    DOB = '$dob', 
    blood_group = '$bloodgroup', 
    DOJ = '$doj', 
    emp_id = '$empID', 
    rank = '$Rank', 
    salary = '$sal', 
    contract = '$contract', 
    username = '$username', 
    password = '$password'
    
    WHERE (emp_id = '$id')
    
    ";
    mysqli_query($conn, $query);
}
?>