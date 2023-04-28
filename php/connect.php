<?php
$IP = "10.0.0.70";
$Port = "5432"
$database = "game4";
$username = "postgres";
$password = "123";

$conn = pg_connect("$IP $Port $database $username $password");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>