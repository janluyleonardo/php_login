<?php
require 'database.php';

session_start();

if (isset($_SESSION['user_id'])) {
  header('Location: /php-login');
}

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = 'Ingrese sus credenciales';

  if (empty($results)) {
    $message = 'Sorry, I have no records matching those credentials yet, please register as a new user. ';
  } else if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
    $_SESSION['user_id'] = $results['id'];
    header("Location: /php_login");
  } else {
    $message = 'Sorry, those credentials do not match';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
  <?php require 'partials/header.php'; ?>
  <div class="container">
    <div class="row">
      <div class="col-md-6 m-auto">
        <div class="card">
          <div class="card-header text-center">
            <h1>Singin</h1>
            <?php if (!empty($message)) : ?>
              <p class="text-danger"> <?= $message ?></p>
            <?php endif; ?>
          </div>
          <div class="card-body text-center">
            <form action="login.php" method="POST">
              <!-- Email input -->
              <div class="form-outline mb-2">
                <input type="email" class="form-control" name="email" placeholder="Enter your email" />
                <!-- <label class=" form-label" for="form2Example1">Email address</label> -->
              </div>
              <!-- Password input -->
              <div class="form-outline mb-2">
                <input type="password" class="form-control" name="password" placeholder="Enter your Password" />
                <!-- <label class="form-label" for="form2Example2">Password</label> -->
              </div>
              <!-- 2 column grid layout for inline styling -->
              <div class="row mb-2">
                <div class="col d-flex justify-content-center">
                  <!-- Checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                    <label class="form-check-label" for="form2Example31"> Remember me </label>
                  </div>
                </div>
                <div class="col">
                  <!-- Simple link -->
                  <a href="#!">Forgot password?</a>
                </div>
              </div>
              <!-- Submit button -->
              <div class="col-md-6 m-auto d-grid gap-2">
                <button type="submit" class="btn btn-outline-primary btn-md btn-block mb-4">Sign in</button>
              </div>
            </form>
            <!-- Register buttons -->
            <p class="text-center mt-0">
              Not a member? <a href="signup.php">Register</a><br>
              or sign up with:
            </p>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-md-1 m-auto">
                <button type="button" class="btn btn-link btn-lg btn-floating mx-1">
                  <i class="bi bi-facebook" width="100"></i>
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