<?php
$conn = new mysqli("mysql_db", "newuser", "newpassword", "ctf_db", 3306);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

