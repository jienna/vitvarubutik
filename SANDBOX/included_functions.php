<?php
function redirect_to($new_location){
  header("Location: " . $new_location);
  exit;
}
// require_once("included_functions.php"); On the top!!!
 ?>
