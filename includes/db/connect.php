<?php

  require('login.php');

  // -------------------------
  // CONNECT TO MySQL DATABASE
  // -------------------------
  $con = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
  if (!$con) {
    die('Kunde inte koppla till databas: ' . mysqli_error($con));
  }
  // -------------------------


  // -------------------------
  // SET CHARSET
  // -------------------------
  if (!mysqli_set_charset($con, $db_charset))
  {
    die('Det går inte att ställa in databasanslutningens kodning.');
  }
  // -------------------------


?>
