<?php

  $db_hostname = 'localhost';
  $db_database = 'vitvarubutik';
  $db_username = 'root';
  $db_password = '';
  $db_charset = "utf8";

  // -------------------------
  // CONNECT
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
