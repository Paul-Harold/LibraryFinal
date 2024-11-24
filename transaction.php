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
    <style>
        .btn-sm {
            width: 70px;
        }

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
                    <th>Loan ID</th>
                    <th>Book Title</th>
                    <th>Member Name</th>
                    <th>Loan Date</th>
                    <th>Due Date</th>
                    <th>Returned Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($conn, "
                SELECT bt.loan_id, b.title, CONCAT(br.first_name, ' ', br.last_name) AS member_name, bt.loan_date, bt.due_date, bt.returned_date
                FROM BorrowTransaction bt
                JOIN Books b ON bt.book_id = b.book_id
                JOIN borrower br ON bt.member_id = br.member_id
                ");
                while ($row = mysqli_fetch_array($res)) {
                    echo "<tr>";
                    echo "<td>" . $row["loan_id"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["member_name"] . "</td>";
                    echo "<td>" . $row["loan_date"] . "</td>";
                    echo "<td>" . $row["due_date"] . "</td>";
                    echo "<td>" . $row["returned_date"] . "</td>";
                    ?>
                    <td class="action-buttons">
                        <a href="Edit/edittransaction.php?id=<?php echo $row["loan_id"]; ?>">
                            <button type="button" class="btn btn-success">Edit</button>
                        </a>
                        <a href="Delete/deletetransaction.php?id=<?php echo $row["loan_id"]; ?>">
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
