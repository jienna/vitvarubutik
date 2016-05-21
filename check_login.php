<?php
if (empty($_REQUEST['username']))
{
  include 'index.html';
}
else
{
  $username = $_REQUEST['username'];
  $password = $_REQUEST['password'];
  if($username == 'john' && $password == 'cena')
  {
    $output = 'Welcome the king!';
    include 'admin.html.php';
  }
  else
  {
    $output = 'Welcome to our web site, '.htmlspecialchars($username, ENT_QUOTES, 'UTF-8').'!';
    include 'welcome.html.php';
  }
}
?>
