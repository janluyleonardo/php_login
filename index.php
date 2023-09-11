<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {
  $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
    $user = $results;
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Welcome to you WebApp</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
  <?php require 'partials/header.php' ?>

  <?php if (!empty($user)) : ?>

    <div class="alert alert-success" role="alert">
      You are Successfully Logged In
    </div>
    <a href="logout.php">
      Logout
    </a>
  <?php else : ?>
    <div class="container">
      <div class="row">
        <div class="col-md-3 m-auto">
          <div class="card">
            <h5 class="card-header text-center">Please Signin or SignUp</h5>
            <div class="card-body">
              <div class="text-center">
                <img src="images/login.gif" alt="" width="227">
                <div class="col-md-12">
                  <a href="login.php" class="btn btn-lg btn-primary" width="50%">Singin</a>
                  <a href="signup.php" class="btn btn-lg btn-primary" width="50%">SignUp</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <h1></h1>

    <a href="login.php"></a> or
    <a href="signup.php"></a> -->
  <?php endif; ?>
  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
</body>

</html>