<?php

require 'database.php';

$messageError = '';
$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':email', $_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $stmt->bindParam(':password', $password);

  try {
    $stmt->execute();
    $message = 'Successfully created new user';
  } catch (PDOException $th) {
    $messageError = 'Sorry there must have been an issue creating your account' . $th;
  }
  // if ($stmt->execute()) {
  //   $message = 'Successfully created new user';
  // } else {
  //   $message = 'Sorry there must have been an issue creating your account';
  // }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>SignUp</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>

  <?php require 'partials/header.php' ?>
  <!-- <h1>SignUp</h1>
  <span>or <a href="login.php">Login</a></span>

  <form action="signup.php" method="POST">
    <input name="email" type="text" placeholder="Enter your email">
    <input name="password" type="password" placeholder="Enter your Password">
    <input name="confirm_password" type="password" placeholder="Confirm Password">
    <input type="submit" value="Submit">
  </form> -->
  <div class="container">
    <div class="row">
      <div class="col-md-6 m-auto">
        <div class="card">
          <div class="card-header text-center">
            <h1>Singup</h1>
            <?php if (!empty($message)) : ?>
              <p class="text-success"> <?= $message ?></p>
            <?php endif; ?>
            <?php if (!empty($messageError)) : ?>
              <p class="text-danger"> <?= $messageError ?></p>
            <?php endif; ?>
          </div>
          <div class="card-body text-center">
            <form action="login.php" method="POST">
              <!-- Email input -->
              <div class="form-outline mb-2">
                <input type="email" class="form-control" name="email" placeholder="Enter your email" />
              </div>
              <!-- Password input -->
              <div class="form-outline mb-2">
                <input type="password" class="form-control" name="password" placeholder="Enter your Password" />
              </div>
              <!-- Confirm password input -->
              <div class="form-outline mb-2">
                <input type="confirm_password" class="form-control" name="password" placeholder="Confirm your Password" />
              </div>
              <!-- Submit button -->
              <div class="col-md-6 m-auto d-grid gap-2">
                <button type="submit" class="btn btn-outline-primary btn-md btn-block mb-4">Sign in</button>
              </div>
            </form>
            <!-- Register buttons -->
            <p class="text-center mt-0">
              already registered?? <a href="login.php">Sign In</a><br>
              or sign up with:
            </p>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-md-1 m-auto">
                <button type="button" class="btn btn-link btn-lg btn-floating mx-1">
                  <i class="bi bi-facebook"></i>
                </button>
              </div>
              <div class="col-md-1 m-auto">
                <button type="button" class="btn btn-link btn-lg btn-floating mx-1">
                  <i class="bi bi-google"></i>
                </button>
              </div>
              <div class="col-md-1 m-auto">
                <button type="button" class="btn btn-link btn-lg btn-floating mx-1">
                  <i class="bi bi-twitter"></i>
                </button>
              </div>
              <div class="col-md-1 m-auto">
                <button type="button" class="btn btn-link btn-lg btn-floating mx-1">
                  <i class="bi bi-github"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>