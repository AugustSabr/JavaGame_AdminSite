<?php
$servername = "localhost";
$username = "Admin";
$password = "HmBw1yvcYpkawfFu";
$database = "game4";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>