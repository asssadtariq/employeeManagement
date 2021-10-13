<?php
session_start();

require_once "../confi.php";
if (@$_SESSION['user_type'] == "Admin") {
  header("location:../Admin/admin_home.php");
} else if (@$_SESSION['user_type'] == "Employee") {
  header("location:../Employees/emp_home.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
  <link rel="stylesheet" href="login.css">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 100px;">
    <div class="container-fluid">
      <a class="navbar-brand" style="font-size: 45px;" href="#">Codeza</a>
    </div>
  </nav>

  <div class="wrapper w-100 d-flex justify-content-center">
    <form class="form-signin w-50" method="POST">
      <h2 class="form-signin-heading text-center">Please Login</h2>
      <input type="email" class="form-control" name="username" placeholder="Email Address" required="" autofocus="" />
      <input type="password" class="form-control" name="userpass" placeholder="Password" required="" />
      <select name="type" id="sel_user" class="form-select fs-3 my-2" aria-label="Default select example">
        <option value="emp">Employee</option>
        <option value="admin">Admin</option>
      </select> <br>
      <button class="btn btn-lg btn-dark btn-block" name="connect" type="submit">Login</button>
    </form>
  </div>

  <!-- partial -->

  <script src="login.js"></script>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>


</body>

</html>

<?php
if (isset($_POST['connect'])) {
  unset($_POST['connect']);

  $user = $_POST['username'];
  $pass = $_POST['userpass'];

  if ($_POST['type'] == "admin") {
    $query = "SELECT * FROM admins WHERE(username = '$user' AND password = '$pass')";
    $result = mysqli_query($conn, $query);
  } else if ($_POST['type'] == "emp") {
    $query = "SELECT * FROM employees WHERE(username = '$user' AND password = '$pass')";
    $result = mysqli_query($conn, $query);
  }

  if (@mysqli_num_rows($result) >= 1) {
    $_SESSION['user_email'] = $user;
    if ($_POST['type'] == "admin") {
      $_SESSION['user_type'] = "Admin";
      header("location:../Admin/admin_home.php");
    } else if ($_POST['type'] == "emp") {
      $_SESSION['user_type'] = "Employee";
      header("location:../Employees/emp_home.php");
    }
  }
}
?>