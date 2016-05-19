<?php

$output = "";
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "vitvarubutik";
$charset = "utf8";

// -------------------------
// CONNECT
// -------------------------
$link = mysqli_connect($servername, $username, $password);
if (!$link)
{
  $output = 'Det gick inte att ansluta till databasservern.';
  include 'output.html.php';
  exit();
}
else {
  $output = $output.'Databas anslutning etablerad.\n';
}
// -------------------------



// -------------------------
// SET CHARSET
// -------------------------
if (!mysqli_set_charset($link, 'utf8'))
{
  $output = 'Det går inte att ställa in databasanslutningens kodning.';
  include 'output.html.php';
  exit();
}
else {
  $output = $output.'Skapade databasen '.$database_name.'.\n';
}
// -------------------------




// -------------------------
// CREATE DATABASE
// -------------------------
$sql = 'CREATE DATABASE IF NOT EXISTS'.$database_name.' CHARACTER SET utf8 COLLATE utf8_general_ci;';
if (!mysqli_query($link, $sql))
{
  $output = 'FEL: ' . mysqli_error($link);
  include 'output.html.php';
  exit();
}
else {
  $output = $output.'Skapade databasen '.$database_name.'.\n';
}

if (!mysqli_select_db($link, $database_name))
{
  $output = 'Det gick inte att hitta databasen '.$database_name.'.';
  include 'output.html.php';
  exit();
}
// -------------------------



// -------------------------
// CREATE TABLES
// -------------------------
$sql =
'CREATE TABLE produkt (
  produkt_id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  namn VARCHAR(255) NOT NULL,
  beskrivning VARCHAR(255) NOT NULL,
  bild VARCHAR(255),
  antal INT NOT NULL DEFAULT 0,
  tillverkare VARCHAR(255),
  modell VARCHAR(255),
  energiklass VARCHAR(255),
  garantitid_manader INT(6) UNSIGNED,
  egenskap VARCHAR(255),
  inkopspris DECIMAL(10, 2),
  aktiv TINYINT(1) DEFAULT 1,
  uppdaterad TIMESTAMP ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)';
if (!mysqli_query($link, $sql))
{
  $output = 'Error: ' . mysqli_error($link);
  include 'output.html.php';
  exit();
}
else {
  $output = $output.'Skapade tabeller.\n';
}
// -------------------------




$output = $output.'FÄRDIG!';
include 'output.html.php';

?>
