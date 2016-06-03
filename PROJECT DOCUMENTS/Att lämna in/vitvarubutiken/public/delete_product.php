<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // START CONNECTION AND GET VAR $con
  require(dirname(dirname(__FILE__))."\includes\db\connect.php");

  $id = intval($_REQUEST['id']);
  if (isset($_REQUEST["btnDelete"])){
    $query  = "DELETE FROM produkt ";
    $query .= "WHERE id=".$id;
    $result = mysqli_query($con,$query);
  }
  else if (isset($_REQUEST["btnDeactivate"])){
    $query  = "UPDATE produkt ";
    $query .= "SET aktiv=0 ";
    $query .= "WHERE id=".$id;
    $result = mysqli_query($con,$query);
  }
  else if (isset($_REQUEST["btnActivate"])){
    $query  = "UPDATE produkt ";
    $query .= "SET aktiv=1 ";
    $query .= "WHERE id=".$id;
    $result = mysqli_query($con,$query);
  }
  $affected_rows = mysqli_affected_rows($con);
  mysqli_close($con);

  if ($result && $affected_rows > 0) {
    $output = "Ändrade rader: " . $affected_rows;
  }
  else{
    $output = "Inga rader ändrades!";
  }

  include 'products.php';
}
else {
  include 'products.php';
}
?>
