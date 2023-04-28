<?php
  session_start();
  include 'connect.php';
  if(!$_SESSION["privileges"] == "all" && !$_SESSION["privileges"] == "web" && !$_SESSION["privileges"] == "game"){
    header("Location: index.php");
  }
  if (isset($_POST["action"])){
    $dbtable = $_POST['dbtable'];
    $id = $_POST['id'];

    if($dbtable == 'weapon' || $dbtable == 'armor' || $dbtable == 'blessing'|| $dbtable == 'enemy'){
      $location = "Location: ../tables.php";
      if ($_POST["action"] == 'update'){
        $tierExists = pg_num_rows(pg_query($conn, "SHOW COLUMNS FROM ".$dbtable."s LIKE '".$dbtable."Tier'"));
        $effectExists = pg_num_rows(pg_query($conn, "SHOW COLUMNS FROM ".$dbtable."s LIKE '".$dbtable."Effect'"));
        $damageExists = pg_num_rows(pg_query($conn, "SHOW COLUMNS FROM ".$dbtable."s LIKE '".$dbtable."Damage'"));
        $healthExists = pg_num_rows(pg_query($conn, "SHOW COLUMNS FROM ".$dbtable."s LIKE '".$dbtable."Health'"));

        $type = pg_escape_string($conn, $_POST[$dbtable.'Type']);
        $sql = "UPDATE ".$dbtable."s SET ".$dbtable."Type = '$type' WHERE id=$id;";
        
        if($tierExists != 0){
          $tier =  pg_escape_string($conn, $_POST[$dbtable.'Tier']);
          $sql .= "UPDATE ".$dbtable."s SET ".$dbtable."Tier = $tier WHERE id=$id;";
        }
        if($effectExists != 0){
          $effect =  pg_escape_string($conn, $_POST[$dbtable.'Effect']);
          $sql .= "UPDATE ".$dbtable."s SET ".$dbtable."Effect = $effect WHERE id=$id;";
        }
        if($damageExists != 0){
          $damage =  pg_escape_string($conn, $_POST[$dbtable.'Damage']);
          $sql .= "UPDATE ".$dbtable."s SET ".$dbtable."Damage = $damage WHERE id=$id;";
        }
        if($healthExists != 0){
          $health =  pg_escape_string($conn, $_POST[$dbtable.'Health']);
          $sql .= "UPDATE ".$dbtable."s SET ".$dbtable."Health = $health WHERE id=$id;";
        }
      }
    } else if($dbtable == 'user'){
      $location = "Location: ../manageProfiles.php";
      if ($_POST["action"] == 'update'){
        $username =  pg_escape_string($conn, $_POST['username']);
        $password =  pg_escape_string($conn, $_POST['password']);
        $privileges =  pg_escape_string($conn, $_POST['privileges']);
        if(empty($password)){
          $sql = "UPDATE ".$dbtable."s SET username = '$username', privileges = '$privileges'  WHERE id=$id;";
        } else {
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
          $sql = "UPDATE ".$dbtable."s SET username = '$username', password = '$hashedPwd', privileges = '$privileges'  WHERE id=$id;";
        }
      }
    } else if($dbtable == 'faq'){
      $location = "Location: ../manageFAQ.php";
      if ($_POST["action"] == 'update'){
        $qName =  pg_escape_string($conn, $_POST['qName']);
        $qTitle =  pg_escape_string($conn, $_POST['qTitle']);
        $question =  pg_escape_string($conn, $_POST['question']);
        $aName =  pg_escape_string($conn, $_POST['aName']);
        $answer =  pg_escape_string($conn, $_POST['answer']);
        $seen =  pg_escape_string($conn, $_POST['seen']);

        $sql = "UPDATE ".$dbtable."s SET qName = '$qName', qTitle = '$qTitle', question = '$question', aName = '$aName', answer = '$answer', seen = '$seen'  WHERE id=$id;";
      }
    }
    if ($_POST["action"] == 'remove'){
      $sql = "DELETE FROM ".$dbtable."s WHERE id=$id;";
    }

    if (pg_query($conn, $sql)) {
      pg_close($conn);
      header($location);
    } else {
      echo "Error ";
      pg_close($conn);
    }
  } else {
    echo '<p>du skal ikke være her</p>';
  }

