<?php
require_once 'includes/bootstrap.php';
require_once 'includes/auth.php';

if (isset($_POST['loginButton'])) {
  $username = $_POST['inputUser'];
  $password = $_POST['inputPass'];

  if (login($username, $password)) {
    redirect_to('admin.php');
  } else {
    echo '<script>';
    echo 'alert("Invalid username or password")';
    echo '</script>';
  }
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <?php include 'includes/resources.head.php'; ?>
  <title>Jerjer's Library</title>
  <link rel="stylesheet" href="CSS/login.css"/>
</head>

<body>
<!-- background splash image -->
<div class="bg-splash"></div>

<!-- Login form -->
<main id="login" class="container rounded-3 shadow-lg bg-white">
  <form class="mx-4" method="POST" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <div class="mb-3 form-floating">
      <input
        type="text"
        class="form-control"
        id="inputUser"
        name="inputUser"
        placeholder="Username"
        required
      />
      <label for="inputUser" class="form-label">Username</label>
    </div>

    <div class="mb-3 form-floating">
      <input
        type="password"
        class="form-control"
        id="inputPass"
        name="inputPass"
        placeholder="Password"
        required
      />
      <label for="inputPass" class="form-label">Password</label>
    </div>

    <div class="d-grid gap-2">
      <button id="loginButton" name="loginButton" class="btn btn-primary" type="submit">
        Login
      </button>
    </div>

    <div class="text-center mt-3">
      <span>Don't have an account? </span>
      <a href="register.php" class="btn btn-link">Register</a>
    </div>
  </form>
</main>

</body>
</html>
