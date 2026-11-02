<!-- HTML STARTS HERE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home3.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">register</a>
        <li class="nav-item">
        <a class="nav-link" href="login.php">login</a>
      </li>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" >
          <a class="dropdown-item" href="register.php">register</a>
          <a class="dropdown-item" href="login.php">login</a>
                    <a class="dropdown-item" href="?logout=true">logout</a>

        </div>
      </li>
    </ul>
    <a href="?logout=true" class="btn btn-outline-danger my-2 my-lg-0" type="submit">Logout</a>
  </div>
</nav>

<?php
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_start();
    session_destroy();
    header('location:login.php');
}
?>