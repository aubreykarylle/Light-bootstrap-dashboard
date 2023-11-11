<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>

<?php
  $servername = "localhost";
  $username = "root";
  $password = "12345";
  $dbase = "record_db";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbase);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  //echo "connected.";
?>