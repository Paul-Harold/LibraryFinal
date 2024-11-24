<?php
include_once '../includes/connection.php';

$id = $_GET["id"];
mysqli_query($conn, "DELETE FROM books WHERE book_id = $id");
?>
<script type="text/javascript">
    window.location = "../admin.php";
</script>
