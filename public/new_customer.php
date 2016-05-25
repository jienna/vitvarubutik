<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Vitvarubutik</title>
  <?php include dirname(dirname(__FILE__)).'\includes\stylesheets.php'; ?>  
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>
  <header>
    <h1>Lars Bloms vitvarubutik</h1>
    <?php include dirname(dirname(__FILE__)).'\includes\menu.php';?>
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

      mysqli_query($con,$query);

      if (mysqli_affected_rows($con) == 1) {
        $output = "En ny kund skapades.";
      }
      else {
        $output = "En ny kund kunde inte skapas! <br> Error:" . mysqli_error($con);
      }

      mysqli_close($con); // ALWAYS CLOSE THE CONNECTION

    }
  }
  ?>
  <section>
    <form class="" action="" method="post">
      <input type="text" name="namn" value="" required="required" placeholder="Namn">
      <input type="email" name="email" value="" placeholder="Email">
      <input type="tel" name="telefonnummer" value="" placeholder="Telefonnummer">
      <input type="text" name="gatuadress" value="" placeholder="Gatuadress">
      <input type="text" name="stad" value="" placeholder="Stad">
      <input type="text" name="postnummer" value="" placeholder="Postnummer">
      <input type="submit" name="submit" value="Skapa">
    </form>

    <p>
      <?php if (isset($output) && !empty($output))
      {
        echo $output;
      }
      ?>
    </p>
  </section>

  <footer>
  </footer>
</body>
</html>
