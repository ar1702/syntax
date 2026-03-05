<?php
include "db.php";

$id=$_POST['id'];
$conn->query("DELETE FROM employees WHERE id='$id'");
?>