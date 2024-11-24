<?php
include_once '../includes/connection.php';

$id = $_GET["id"];
mysqli_query($conn, "DELETE FROM borrower WHERE member_id = $id");
?>
<script type="text/javascript">
    window.location = "../borrower.php";
</script>
