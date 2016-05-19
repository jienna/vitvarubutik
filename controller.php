<?php
if (!isset($_REQUEST['firstname'])){
  include 'index.html.php';
}
else {
  $firstname = $_REQUEST['firstname'];
  $lastname = $_REQUEST['lastname'];
  if($firstname == 'John' and $lastname = 'Cena'){
    $output = 'Welcome the king!';
  }
  else {
    $output = 'Welcome to our web site, '.
    htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8').' '.
    htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8').'!';
  }
  include 'welcome.html.php';
}
?>
