<?php

$output = "";
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "vitvarubutik";
$charset = "utf8";

$sqlFileToExecute = "create.sql";

// -------------------------
// CONNECT
// -------------------------
$con = mysqli_connect($servername, $username, $password);
if (!$con)
{
  $output = 'Det gick inte att ansluta till databasservern.';
  include 'output.html.php';
  exit();
}
else {
  $output = $output.'Databas anslutning etablerad.<br>';
}
// -------------------------



// -------------------------
// SET CHARSET
// -------------------------
if (!mysqli_set_charset($con, $charset))
{
  $output = 'Det går inte att ställa in databasanslutningens kodning.';
  include 'output.html.php';
  exit();
}
else {
  $output = $output.'Ställde in databasanslutningens till '.$charset.'.<br>';
}
// -------------------------



//
// // -------------------------
// // CREATE DATABASE
// // -------------------------
// $sql = 'CREATE DATABASE IF NOT EXISTS '.$database_name.' CHARACTER SET utf8 COLLATE utf8_general_ci;';
// if (!mysqli_query($con, $sql))
// {
//   $output = 'FEL: ' . mysqli_error($con);
//   include 'output.html.php';
//   exit();
// }
// else {
//   $output = $output.'Skapade databasen '.$database_name.'.\n';
// }
//
// if (!mysqli_select_db($con, $database_name))
// {
//   $output = 'Det gick inte att hitta databasen '.$database_name.'.';
//   include 'output.html.php';
//   exit();
// }
// // -------------------------
//
//
//
// // -------------------------
// // CREATE TABLES
// // -------------------------
// $sql = "";
// if (!mysqli_query($con, $sql))
// {
//   $output = 'Error: ' . mysqli_error($con);
//   include 'output.html.php';
//   exit();
// }
// else {
//   $output = $output.'Skapade tabeller.\n';
// }
// // -------------------------


// read the sql file
$f = fopen($sqlFileToExecute,"r+");
$sqlFile = fread($f, filesize($sqlFileToExecute));
$sqlArray = explode(';',$sqlFile);
foreach ($sqlArray as $stmt) {
  if (strlen($stmt)>3 && substr(ltrim($stmt),0,2)!='/*') {
    $result = mysqli_query($con, $stmt);
    if (!$result) {
      $sqlErrorCode = mysqli_errno($con);
      $sqlErrorText = mysqli_error($con);
      $sqlStmt = $stmt;
      break;
    }
  }
}
if (empty($sqlErrorCode)) {
  $output = $output."Script was executed succesfully! ";
} else {
  $output = $output."An error occured during installation! ";
  $output = $output."Error code: ".$sqlErrorCode." ";
  $output = $output."Error text: ".$sqlErrorText." ";
  $output = $output."Statement:<br>".$sqlStmt." ";
}



$output = $output.'FÄRDIG!';
include 'output.html.php';

?>
