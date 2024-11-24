<?php
include_once 'connection.php';

$title = $_POST['title'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$publication_date = $_POST['publication_date'];
$genre = $_POST['genre'];


$stmt = $conn->prepare("INSERT INTO Books (title, author, publisher, publication_date, genre) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $title, $author, $publisher, $publication_date, $genre);


if ($stmt->execute()) {
    header("Location:../admin.php?addbook=success");
} else {

    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
