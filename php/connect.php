<?php
$IP = "host=localhost";
$Port = "port=5432";
$database = "dbname=game4";
$username = "user=postgres";
$password = "password=123";

$conn_string = "$IP $Port $database $username $password";
$conn = pg_connect("$conn_string");

if (!$conn) {
  die("Connection failed: Databasen er ikke tilgjenlig");
}
?>
<!-- host=10.0.0.70 port=5432 dbname=game4 user=postgres password=123 -->