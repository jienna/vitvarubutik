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
      $beskrivning = $_REQUEST['beskrivning'];
      $telefonnummer = $_REQUEST['telefonnummer'];
      $gatuadress = $_REQUEST['gatuadress'];
      $stad = $_REQUEST['stad'];
      $postnummer = $_REQUEST['postnummer'];
      $land = $_REQUEST['land'];
      $aktiv = isset($_REQUEST['aktiv']) ? 1 : 0 ;

      // Get mysql connection $con
      require (dirname(dirname(__FILE__))."\includes\db\connect.php");

      $query  = "INSERT INTO leverantor ";
      $query .= "(namn, beskrivning, telefonnummer, gatuadress, stad, postnummer,
      land, aktiv) ";
      $query .= "VALUES ('".$namn."', '".$beskrivning."', '".$telefonnummer."',
      '".$gatuadress."', '".$stad."', '".$postnummer."', '".$land."',
      ".$aktiv.")";

      mysqli_query($con,$query);

      if (mysqli_affected_rows($con) == 1) {
        $output = "En ny leverantör skapades.";
      }
      else {
        $output = "En ny leverantör kunde inte skapas! <br> Error:" . mysqli_error($con);
      }

      mysqli_close($con); // ALWAYS CLOSE THE CONNECTION

    }
  }
  ?>
  <section>
    <form class="" action="" method="post">
      <input type="text" name="namn" value="" required="required" placeholder="Namn">
      <textarea rows="5" name="beskrivning" value="" placeholder="Beskrivning"></textarea>
      <input type="tel" name="telefonnummer" value="" placeholder="Telefonnummer">
      <input type="text" name="gatuadress" value="" placeholder="Gatuadress">
      <input type="text" name="stad" value="" placeholder="Stad">
      <input type="text" name="postnummer" value="" placeholder="Postnummer">
      <input type="text" name="land" value="" placeholder="Land">
      <input type="checkbox" name="aktiv" value="1" checked>
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
