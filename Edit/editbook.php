<?php
include_once '../includes/connection.php';

$id = $_GET["id"];
$title = "";
$author = "";
$publisher = "";
$publication_date = "";
$genre = "";

$res = mysqli_query($conn, "SELECT * FROM books WHERE book_id = $id");

while ($row = mysqli_fetch_array($res)) {
    $title = $row["title"];
    $author = $row["author"];
    $publisher = $row["publisher"];
    $publication_date = $row["publication_date"];
    $genre = $row["genre"];
}

if (isset($_POST["update"])) {
    $updateStmt = $conn->prepare("UPDATE books SET title=?, author=?, publisher=?, publication_date=?, genre=? WHERE book_id=?");
    $updateStmt->bind_param("sssssi", $_POST["title"], $_POST["author"], $_POST["publisher"], $_POST["publication_date"], $_POST["genre"], $id);

    if ($updateStmt->execute()) {
        ?>
        <script type="text/javascript">
            window.location = "../admin.php";
        </script>
        <?php
    } else {
        echo "Error updating book: " . $conn->error;
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
          <form action="" name=editbook method="post" class="border p-3">
          <fieldset>
              <legend>Books</legend>
              <div class="form-group pb-2">
                <label for="title">Title</label>
                <input type="text" class="form-control" placeholder="Enter New Title" name="title" value="<?php echo $title; ?>">
              </div>
              <div class="form-group pb-2">
                <label for="author">Author</label>
                <input type="text" class="form-control" placeholder="Enter new Author" name="author" value="<?php echo $author; ?>">
              </div>
              <div class="form-group pb-2">
                <label for="publisher">Publisher</label>
                <input type="text" class="form-control" placeholder="Enter new Publisher" name="publisher" value="<?php echo $publisher; ?>">
              </div>
              <div class="form-group pb-2">
                <label for="publication_date">Publication Date</label>
                <input type="text" class="form-control" placeholder="Enter new Publication Date" name="publication_date" value="<?php echo $publication_date; ?>">
              </div>
              <div class="form-group pb-2">
                <label for="genre">Genre</label>
                <input type="text" class="form-control" placeholder="Enter new genre" name="genre" value="<?php echo $genre; ?>">
              </div>
              <button type="submit" name="update" class="btn btn-primary">Update</button>
            </fieldset>
          </form>
          <?php
        if(isset($_POST["update"]))
        {
        mysqli_query($conn,"update books set title='$_POST[title]',author='$_POST[author]',publisher='$_POST[publisher]',publication_date='$_POST[publication_date]',genre='$_POST[genre]' where book_id=$id");
        ?>
        <script type="text/javascript">
        window.location="../admin.php";
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