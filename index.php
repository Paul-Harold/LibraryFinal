<?php
include_once 'includes/connection.php';

// Set default sort order by Book ID
$sortOrder = "book_id ASC";

// Check if the sort form has been submitted
if (isset($_POST['sort_submit'])) {
    $sortField = $_POST['sort_field'];

    // Set sort order based on the selected field
    switch ($sortField) {
        case "title":
            $sortOrder = "title ASC";
            break;
        case "book_id":
        default:
            $sortOrder = "book_id ASC";
            break;
    }
}

// Query the database with the selected sort order
$res = mysqli_query($conn, "SELECT * FROM books ORDER BY " . $sortOrder);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link rel="stylesheet" type="text/css" href="CSS/borrow.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 16px;
            display: inline-block;
        }
        .navbar a:hover {
            background-color: #5a6268;
        }
        .sort-form {
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #343a40;
            color: white;
        }
        .borrow-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .borrow-button:hover {
            background-color: #0056b3;
        }
        .borrow-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .close-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            float: right;
        }
        .close-button:hover {
            background-color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.php">Jerjer's Books</a>
        <a href="login.php">Admin</a>
    </div>
    <div class="container">
        <div class="sort-form">
            <form method="POST">
                <label for="sort_field">Sort By:</label>
                <select class="form-control" name="sort_field">
                    <option value="book_id">Book ID</option>
                    <option value="title">Title</option>
                </select>
                <button type="submit" name="sort_submit" class="btn btn-primary mt-2">Sort</button>
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Year</th>
                    <th>Program</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($res)) {
                    echo "<tr>";
                    echo "<td>" . $row["book_id"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["author"] . "</td>";
                    echo "<td>" . $row["publisher"] . "</td>";
                    echo "<td>" . $row["publication_date"] . "</td>";
                    echo "<td>" . $row["genre"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <button class="borrow-button" onclick="showBorrowForm()">Borrow a Book</button>

        <div class="borrow-form" id="borrowForm">
            <button class="close-button" id="closeBtn">&times;</button>
            <h2>Borrow a Book</h2>
            <form action="includes/borrow.php" method="POST">
                <!-- Your form fields go here -->
                <button type="submit" class="btn btn-primary">Borrow</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Add a click event listener to the borrow button
        document.querySelector(".borrow-button").addEventListener("click", function() {
            // Show the borrow form
            document.getElementById("borrowForm").style.display = "block";
        });

        // Add a click event listener to the close button
        document.getElementById("closeBtn").addEventListener("click", function() {
            // Hide the borrow form
            document.getElementById("borrowForm").style.display = "none";
        });

        function showBorrowForm() {
            document.getElementById("borrowForm").style.display = "block";
        }

        function sortTable(columnName) {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.querySelector(".table");
            switching = true;
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[columnName];
                    y = rows[i + 1].getElementsByTagName("TD")[columnName];
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }
    </script>
</body>
</html>
