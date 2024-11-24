<?php
include_once '../includes/connection.php';

$id = $_GET["id"];
mysqli_query($conn, "DELETE FROM transaction WHERE loan_id = $id");
?>
<script type="text/javascript">
    window.location = "../transaction.php";
</script>
