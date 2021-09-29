<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Codeza-Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="wrapper">
    <h2 class="text-light fs-1">Codeza</h2>
    <form class="login">
      <p class="title">Log in</p>
      <input type="text" placeholder="Username" autofocus />
      <i class="fa fa-user  "></i>
      <input type="password" placeholder="Password" />
      <i class="fa fa-key"></i>

      <select name="type" id="admin_emp" class="btn btn-dark my-2"> Select As ..
        <option value="employee"> Employee </options>
        <option value="admin"> Admin </options>
      </select>
      <br>
      <a href="#">Forgot your password?</a>
      <button class="bg-primary">
        <i class="spinner"></i>
        <span class="state fs-3">CONNECT</span>
      </button>
    </form>
    </p>
  </div>

  <!-- partial -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="login.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>