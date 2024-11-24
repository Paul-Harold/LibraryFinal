<?php
include_once 'includes/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="CSS/borrow.css">
    <link rel="stylesheet" href="CSS/admin-panel.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }

        .sidebar h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        .fixed-bottom {
            position: fixed;
            bottom: 0;
            right: 0;
            left: 0;
            padding: 10px;
            background-color: #f5f5f5;
            border-top: 1px solid #ddd;
            text-align: right;
        }

        .modal-dialog {
            max-width: 400px;
            margin: 30px auto;
        }

        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
        }

        .action-buttons {
            display: flex;
            justify-content: space-around;
        }

        .action-buttons button {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1>Admin Panel</h1>
        <a href="admin.php">Books</a>
        <a href="borrower.php">Borrower</a>
        <a href="transaction.php">Borrow Transaction</a>
    </div>
    <div class="content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Publication Date</th>
                    <th>Genre</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($conn, "SELECT * FROM books");
                while ($row = mysqli_fetch_array($res)) {
                    echo "<tr>";
                    echo "<td>" . $row["book_id"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["author"] . "</td>";
                    echo "<td>" . $row["publisher"] . "</td>";
                    echo "<td>" . $row["publication_date"] . "</td>";
                    echo "<td>" . $row["genre"] . "</td>";
                    ?>
                    <td class="action-buttons">
                        <a href="Edit/editbook.php?id=<?php echo $row["book_id"]; ?>">
                            <button type="button" class="btn btn-success btn-sm">Edit</button>
                        </a>
                        <a href="Delete/deletebook.php?id=<?php echo $row["book_id"]; ?>">
                            <button type="button" class="btn btn-danger btn-sm">Delete</button>
                        </a>
                    </td>
                    <?php
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="fixed-bottom">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBookModal">Add Book</button>
    </div>

    <div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="addBookModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBookModalLabel">Add Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="includes/addbook.php" method="POST">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" class="form-control" name="author" required>
                        </div>
                        <div class="form-group">
                            <label for="publisher">Publisher:</label>
                            <input type="text" class="form-control" name="publisher" required>
                        </div>
                        <div class="form-group">
                            <label for="publication_date">Publication Date:</label>
                            <input type="date" class="form-control" name="publication_date" required>
                        </div>
                        <div class="form-group">
                            <label for="genre">Genre:</label>
                            <input type="text" class="form-control" name="genre" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sticky button code
        window.onscroll = function () { stickyFunction() };

        var addButton = document.getElementById("addButton");
        var sticky = addButton.offsetTop;

        function stickyFunction() {
            if (window.pageYOffset >= sticky) {
                addButton.classList.add("sticky");
            } else {
                addButton.classList.remove("sticky");
            }
        }
    </script>
</body>
</html>
