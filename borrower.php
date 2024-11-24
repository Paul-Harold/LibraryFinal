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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
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
            color: white;
        }

        .sidebar h1 {
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
                    <th>Member ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Book ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($conn, "SELECT * FROM borrower");
                while ($row = mysqli_fetch_array($res)) {
                    echo "<tr>";
                    echo "<td>" . $row["member_id"] . "</td>";
                    echo "<td>" . $row["first_name"] . "</td>";
                    echo "<td>" . $row["last_name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["phone_number"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["book_id"] . "</td>";
                    ?>
                    <td class="action-buttons">
                        <a href="Edit/editborrower.php?id=<?php echo $row["member_id"]; ?>">
                            <button type="button" class="btn btn-success">Edit</button>
                        </a>
                        <a href="Delete/deleteborrower.php?id=<?php echo $row["member_id"]; ?>">
                            <button type="button" class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                    <?php
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
