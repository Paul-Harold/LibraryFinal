<?php
include_once '../includes/connection.php';

$id = $_GET["id"];
$book_id = "";
$member_id = "";
$loan_date = "";
$due_date = "";
$returned_date = "";

$res = mysqli_query($conn, "SELECT * FROM BorrowTransaction WHERE loan_id='$id'");

while ($row = mysqli_fetch_array($res)) {
    $book_id = $row["book_id"];
    $member_id = $row["member_id"];
    $loan_date = $row["loan_date"];
    $due_date = $row["due_date"];
    $returned_date = $row["returned_date"];
}

if (isset($_POST["update"])) {
    $updateStmt = $conn->prepare("UPDATE BorrowTransaction SET book_id=?, member_id=?, loan_date=?, due_date=?, returned_date=? WHERE loan_id=?");
    $updateStmt->bind_param("sssssi", $_POST["book_id"], $_POST["member_id"], $_POST["loan_date"], $_POST["due_date"], $_POST["returned_date"], $id);

    if ($updateStmt->execute()) {
        ?>
        <script type="text/javascript">
            window.location = "../transaction.php";
        </script>
        <?php
    } else {
        echo "Error updating borrow transaction: " . $conn->error;
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
          <form action="" name=editborrowtransaction method="post" class="border p-3">
          <fieldset>
              <legend>Borrow Transaction</legend>
              <div class="form-group pb-2">
                <label for="book_id">Book ID</label>
                <input type="text" class="form-control" placeholder="Enter new Book ID" name="book_id" value="<?php echo $book_id; ?>">
              </div>
              <div class="form-group pb-2">
                <label for="member_id">Member ID</label>
                <input type="text" class="form-control" placeholder="Enter new Member ID" name="member_id" value="<?php echo $member_id; ?>">
              </div>
              <div class="form-group pb-2">
                <label for="loan_date">Loan Date</label>
                <input type="date" class="form-control" placeholder="Enter new Loan Date" name="loan_date" value="<?php echo $loan_date; ?>">
              </div>
              <div class="form-group pb-2">
                <label for="due_date">Due Date</label>
                <input type="date" class="form-control" placeholder="Enter new Due Date" name="due_date" value="<?php echo $due_date; ?>">
              </div>
              <div class="form-group pb-2">
                <label for="returned_date">Returned Date</label>
                <input type="date" class="form-control" placeholder="Enter new Returned Date" name="returned_date" value="<?php echo $returned_date; ?>">
              </div>
              <button type="submit" name="update" class="btn btn-primary">Update</button>
            </fieldset>
          </form>
          <?php

        if(isset($_POST["update"]))
        {
        mysqli_query($conn,"update borrowtransaction set book_id='$_POST[book_id]',member_id='$_POST[member_id]',loan_date='$_POST[loan_date]',due_date='$_POST[due_date]',returned_date='$_POST[returned_date]' where loan_id=$id");
        ?>
        <script type="text/javascript">
        window.location="../transaction.php";
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