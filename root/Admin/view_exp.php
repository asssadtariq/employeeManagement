<?php
session_start();
require_once "../confi.php";

$query = "SELECT * FROM expenses";
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
    <title>Codeza - Employee Details</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top position-relative">
        <div class="container-fluid">
            <a class="navbar-brand fs-1 mx-1" href="#">Codeza - Expenses Information</a>

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

    <div class="att-table my-1">
        <div class="search-box">
            <form action="" method="POST">
                <div class="input-group mb-3" style="margin-left: 5px; height: 50px;">
                    <input type="text" name="searchVal" class="form-control" placeholder="Search here" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-dark" name="searchBtn" style="width: 10%; margin-right: 10px;" type="submit" id="button-addon2">Search</button>
                    <button class="btn btn-dark" name="dispAll" style="width: 10%; margin-right: 10px;" type="submit" id="button-addon2">Display All</button>
                </div>
            </form>

            <?php
            if (isset($_POST['searchBtn'])) {
                unset($_POST['searchBtn']);
                $search = $_POST['searchVal'];

                $query_SEARCH = "SELECT * FROM expenses WHERE (expense_name LIKE ('%$search%'))";
                $query_result = mysqli_query($conn, $query_SEARCH);
                if (@mysqli_num_rows($query_result) <= 0) {
                    $query_SEARCH = "SELECT * FROM expenses WHERE (exp_date LIKE ('%$search%'))";
                    $query_result = mysqli_query($conn, $query_SEARCH);
                    if (@mysqli_num_rows($query_result) <= 0) {
                        $query_SEARCH = "SELECT * FROM expenses WHERE (amount = '$search')";
                        $query_result = mysqli_query($conn, $query_SEARCH);
                    }
                }
            }

            ?>
        
        </div>

        <table class="table">
            <thead class="table-dark">
                <th>#</th>
                <th>Name</th>
                <th>Date</th>
                <th>Amount</th>
            </thead>

            <?php
            $counter = 1;
            while ($query_data = mysqli_fetch_assoc($query_result)) {

            ?>
                <tbody>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $query_data['expense_name']; ?></td>
                    <td><?php echo $query_data['exp_date']; ?></td>
                    <td><?php echo $query_data['amount']; ?></td>
                </tbody>
            <?php
                $counter++;
            }
            ?>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>