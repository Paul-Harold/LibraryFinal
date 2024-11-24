<?php
include_once 'connection.php';

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$address = $_POST['address'];
$book_id = $_POST['book_id'];

$stmt = $conn->prepare("INSERT INTO borrower (first_name, last_name, email, phone_number, address, book_id) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone_number, $address, $book_id);

if ($stmt->execute()) {
    header("Location:../index.php?addbook=success");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
