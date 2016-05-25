<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // START CONNECTION AND GET VAR $con
  require(dirname(dirname(__FILE__))."\includes\db\connect.php");

  $id = intval($_REQUEST['id']);
  if (isset($_REQUEST["btnDelete"])){
    $query  = "DELETE FROM varugrupp ";
    $query .= "WHERE id=".$id;
    $result = mysqli_query($con,$query);
  }
  mysqli_close($con);

  if ($result) {
    $output = "Varugruppen raderades.";
  }
  else{
    $output = "Varugruppen kunde inte raderas!";
  }

  include 'commodity_groups.php';
}
?>
