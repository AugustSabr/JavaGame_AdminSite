<?php
$IP = "10.0.0.70";
$Port = "5432";
$database = "game4";
$username = "postgres";
$password = "123";

echo "host=$IP port=$Port dbname=$database user=$username password=$password"
$conn = pg_connect("host=$IP port=$Port dbname=$database user=$username password=$password");

pg_query($dbconn, "select * from doesnotexist");

if (!$conn) {
  die("Connection failed: " .  pg_last_error($conn));
}
?>