<?php
$IP = "host=10.0.0.70";
$Port = "port=5432";
$database = "dbname=game4";
$username = "user=postgres";
$password = "password=123";

$conn_string = "$IP $Port $database $username $password";
$conn = pg_connect("$conn_string");

pg_query($dbconn, "select * from doesnotexist");

if (!$conn) {
  die("Connection failed: ");
}
?>