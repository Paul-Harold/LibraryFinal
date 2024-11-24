<?php
require_once 'includes/auth.php';

if (isset($_POST['register'])) {
  // get form data
  $username = $_POST['inputUsername'];
  $password = $_POST['inputPassword'];
  $email = $_POST['inputEmail'];
  $firstName = $_POST['inputFirstName'];
  $lastName = $_POST['inputLastName'];

  // validate form data
  if (register_user($username, $password, $email, $firstName, $lastName)) {
    redirect_to('login.php');
  }
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <?php include 'includes/resources.head.php'; ?>
  <title>Register | Hello Keyboard</title>
  <link rel="stylesheet" href="./css/login.css"/>
</head>

<body>
<!-- background splash image -->
<div class="bg-splash"></div>

<!-- Login form -->
<main id="login" class="container rounded-3 shadow-lg bg-white">
  <form class="mx-4" method="POST">
    <div class="mb-3 form-floating">
      <input
        type="email"
        class="form-control"
        id="inputEmail"
        name="inputEmail"
        placeholder="Email"
        maxlength="70"
        required
      />
      <label for="inputEmail" class="form-label">Email</label>
    </div>

    <div class="mb-3 form-floating">
      <input
        type="text"
        class="form-control"
        id="inputUsername"
        name="inputUsername"
        placeholder="Username"
        maxlength="20"
        required
      />
      <label for="inputUsername" class="form-label">Username</label>
    </div>

    <div class="mb-3 form-floating">
      <input
        type="password"
        class="form-control"
        id="inputPassword"
        name="inputPassword"
        placeholder="Password"
        required
      />
      <label for="inputPassword" class="form-label">Password</label>
    </div>

    <span class="text-center text-secondary row my-2">
            <span class="col col-1 w-auto align-self-center">Personal Details</span>
            <span class="col h-auto w-auto"><hr/></span>
          </span>

    <div class="row g-2 mb-3">
      <div class="col-md">
        <div class="form-floating">
          <input type="text" class="form-control" id="inputFirstName" placeholder="First Name"
                 name="inputFirstName" required>
          <label for="firstName">First Name</label>
        </div>
      </div>
      <div class="col-md">
        <div class="form-floating">
          <input type="text" class="form-control" id="inputLastName" placeholder="First Name"
                 name="inputLastName" required>
          <label for="lastName">Last Name</label>
        </div>
      </div>
    </div>

    <div class="d-grid gap-2">
      <button id="registerButton" class="btn btn-primary" type="submit" name="register">
        Register
      </button>

      <span class="text-center text-secondary row my-2">
            <span class="col h-auto"><hr/></span>
            <span class="col col-1 w-auto align-self-center">Already have an account?</span>
            <span class="col h-auto w-auto"><hr/></span>
          </span>

      <button
        id="loginButton"
        class="btn btn-outline-primary"
        type="button"
      >
        Login
      </button>
      <script type="text/javascript">
    document.getElementById("loginButton").onclick = function () {
        location.href = "login.php";
    };
</script>
    </div>
  </form>
</main>

<?php include 'includes/resources.script.php'; ?>
</body>
</html>
