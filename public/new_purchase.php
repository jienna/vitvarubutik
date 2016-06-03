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
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {   // something posted. Deal with it B)
    if (isset($_REQUEST['submit']) && !empty($_REQUEST['kund'])) {
      $antal = $_REQUEST['antal'];
      $datum = $_REQUEST['datum'];
      $produkt = $_REQUEST['produkt'];
      $kund = $_REQUEST['kund'];

      // Get mysql connection $con
      require (dirname(dirname(__FILE__))."\includes\db\connect.php");

      $query  = "INSERT INTO kop ";
      $query .= "(antal, ";
      if (!empty($datum)) {
        $query .= "datum, ";
      }
      $query .= "produkt, kund) ";
      $query .= "VALUES (".$antal.", ";
      if (!empty($datum)) {
        $query .= "'".$datum."', ";
      }
      $query .= $produkt.", ".$kund.") ";

      mysqli_query($con,$query);

      if (mysqli_affected_rows($con) == 1) {
        $output = "Ett nytt köp registrerades.";

        // Ta bort antal från lager.
        $query  = "UPDATE produkt ";
        $query .= "SET antal = (antal - ".$antal.") ";
        $query .= "WHERE id=".$produkt;
        mysqli_query($con,$query);
      }
      else {
        $output = "Ett nytt köp kunde inte registreras! <br> Error:" . mysqli_error($con);
      }

      mysqli_close($con); // ALWAYS CLOSE THE CONNECTION

    }
  }
  ?>
  <section>
    <h2>Registrera köp</h2>
    <form class="" action="" method="post">
      <label>Produkt:</label>
      <br>
      <select name="produkt" required="required">
        <option value=""></option>
        <?php
        // START CONNECTION AND GET VAR $con
        require(dirname(dirname(__FILE__))."\includes\db\connect.php");

        $query  = "SELECT id, namn ";
        $query .= "FROM produkt ";
        $query .= "WHERE aktiv = 1 ";
        $result = mysqli_query($con,$query);

        while($row = mysqli_fetch_array($result)) {
          echo '<option value="'.$row['id'] .'">'.$row['id'] .' - '.$row['namn'].'</option>';
        }
        mysqli_close($con);
        ?>
      </select>
      <br>
      <label>Antal:</label>
      <br>
      <input type="number" name="antal" value="" required="required">
      <br>
      <label>Datum (lämna tomt för nuvarande datum och tid):</label>
      <br>
      <input type="datetime-local" name="datum" value="">
      <br>
      <label>Kund:</label>
      <br>
      <select name="kund" required="required">
        <option value=""></option>
        <?php
        // START CONNECTION AND GET VAR $con
        require(dirname(dirname(__FILE__))."\includes\db\connect.php");

        $query  = "SELECT id, namn ";
        $query .= "FROM kund ";
        $result = mysqli_query($con,$query);

        while($row = mysqli_fetch_array($result)) {
          echo '<option value="'.$row['id'] .'">'.$row['namn'].'</option>';
        }
        mysqli_close($con);
        ?>
      </select>
      <br>
      <br>
      <input type="submit" name="submit" value="Registrera">
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
