<?php
include_once '../includes/connection.php';

$id = $_GET["id"];
$first_name = "";
$last_name = "";
$email = "";
$phone_number = "";
$address = "";
$book_id = "";

$res = mysqli_query($conn, "SELECT * FROM borrower WHERE member_id = '$id'");

while ($row = mysqli_fetch_array($res)) {
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $email = $row["email"];
    $phone_number = $row["phone_number"];
    $address = $row["address"];
    $book_id = $row["book_id"];
}

if (isset($_POST["update"])) {
    $updateStmt = $conn->prepare("UPDATE borrower SET first_name=?, last_name=?, email=?, phone_number=?, address=?, book_id=? WHERE member_id=?");
    $updateStmt->bind_param("sssssi", $_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["phone_number"], $_POST["address"], $_POST["book_id"], $id);

    if ($updateStmt->execute()) {
        ?>
        <script type="text/javascript">
            window.location = "../borrower.php";
        </script>
        <?php
    } else {
        echo "Error updating borrower: " . $conn->error;
    }

    $updateStmt->close();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="../CSS/borrow.css">
    <link rel="stylesheet" href="../CSS/admin-panel.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="sidebar">
      <h1>Admin Panel</h1>
      <a href="../admin.php">Books</a>
      <a href="#">Borrower</a>
      <a href="#">Borrow Transaction</a>
    </div>
    <div class="content">
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
          
          <div class="container">
          <form action="" name=editborrower method="post" class="border p-3">
          <fieldset>
              <legend>Books</legend>
              <div class="form-group pb-2">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" placeholder="Enter New First Name" name="first_name" value="<?php echo $first_name; ?>">
              </div>
              <div class="form-group pb-2">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" placeholder="Enter new Last Name" name="last_name" value="<?php echo $last_name; ?>">
              </div>
              <div class="form-group pb-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" placeholder="Enter new Email" name="email" value="<?php echo $email; ?>">
              </div>
              <div class="form-group pb-2">
                <label for="phone_number">Phone Number</label>
                <input type="tel" class="form-control" placeholder="Enter new Phone number" name="phone_number" value="<?php echo $phone_number; ?>">
              </div>
              <div class="form-group pb-2">
                <label for="address">Address</label>
                <input type="text" class="form-control" placeholder="Enter new Address" name="address" value="<?php echo $address; ?>">
              </div>
              <div class="form-group pb-2">
                <label for="book_id">Book ID</label>
                <input type="text" class="form-control" placeholder="Enter new Book ID" name="book_id" value="<?php echo $book_id; ?>">
              </div>
              <button type="submit" name="update" class="btn btn-primary">Update</button>
            </fieldset>
          </form>
          <?php
        if(isset($_POST["update"]))
        {
        mysqli_query($conn,"update borrower set first_name='$_POST[first_name]',last_name='$_POST[last_name]',email='$_POST[email]',phone_number='$_POST[phone_number]',address='$_POST[address]',book_id='$_POST[book_id]' where member_id=$id");
        ?>
        <script type="text/javascript">
        window.location="../borrower.php";
        </script>
        <?php
        }
        ?>
          
          </div>
        </div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->
  <!-- jQuery -->
</body>
</html>