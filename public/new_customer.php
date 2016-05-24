<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Vitvarubutik</title>
  <link rel="stylesheet" href="css/styles.css">
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>
  <header>
    <a href="index.php"><h1>Lars Bloms vitvarubutik</h1></a>
  </header>
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {   //something posted
    if (isset($_REQUEST['submit']) && !empty($_REQUEST['namn'])) {
      $namn = $_REQUEST['namn'];
      $email = $_REQUEST['email'];
      $telefonnummer = $_REQUEST['telefonnummer'];
      $gatuadress = $_REQUEST['gatuadress'];
      $stad = $_REQUEST['stad'];
      $postnummer = $_REQUEST['postnummer'];

      // Get mysql connection $con
      require (dirname(dirname(__FILE__))."\includes\db\connect.php");

      $query  = "INSERT INTO kund ";
      $query .= "(namn, email, telefonnummer, gatuadress, stad, postnummer) ";
      $query .= "VALUES ('".$namn."', '".$email."', '".$telefonnummer."', '".$gatuadress."', '".$stad."', '".$postnummer."')";

      $result = mysqli_query($con,$query);

      mysqli_close($con); // ALWAYS CLOSE THE CONNECTION
      
    }
  }
  ?>
  <section>
    <form class="" action="" method="post">
      <input type="text" name="namn" value="" required="required" placeholder="Namn">
      <input type="text" name="email" value="" placeholder="Email">
      <input type="tel" name="telefonnummer" value="" placeholder="Telefonnummer">
      <input type="text" name="gatuadress" value="" placeholder="Gatuadress">
      <input type="text" name="stad" value="" placeholder="Stad">
      <input type="text" name="postnummer" value="" placeholder="Postnummer">
      <input type="submit" name="submit" value="Skapa">
    </form>
  </section>

  <footer>
  </footer>
</body>
</html>
