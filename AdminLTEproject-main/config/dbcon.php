<?php
$conn = mysqli_connect("localhost", "root", "Anmol123#", "project");
if (!$conn) {
    header("Location: ../errors/db.php");
    die(mysqlhi_connect_error($conn));
}
?>