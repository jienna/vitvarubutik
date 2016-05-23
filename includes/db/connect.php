<?php

  require('login.php');

  // -------------------------
  // CONNECT TO MySQL DATABASE
  // -------------------------
  $con = mysqli_connect('localhost','root','','vitvarubutik');
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
