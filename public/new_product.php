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
      $bild = $_REQUEST['bild'];

      $formatter = new \NumberFormatter('sv-SE', \NumberFormatter::PATTERN_DECIMAL);
      if ($formatter->parse($_REQUEST['pris']) !== false) {
        $pris = $_REQUEST['pris'];
      }

      $antal = intval($_REQUEST['antal']);
      $tillverkare = $_REQUEST['tillverkare'];
      $modell = $_REQUEST['modell'];
      $energiklass = $_REQUEST['energiklass'];
      $garantitid_manader = intval($_REQUEST['garantitid_manader']);
      $egenskap = $_REQUEST['egenskap'];

      $formatter = new \NumberFormatter('sv-SE', \NumberFormatter::PATTERN_DECIMAL);
      if ($formatter->parse($_REQUEST['inkopspris']) !== false) {
        $inkopspris = $_REQUEST['inkopspris'];
      }

      $leverantor = intval($_REQUEST['leverantor']);
      $aktiv = isset($_REQUEST['aktiv']) ? 1 : 0 ;

      $varugrupp = $_REQUEST['varugrupp'];

      // Get mysql connection $con
      require (dirname(dirname(__FILE__))."\includes\db\connect.php");

      $query  = "INSERT INTO produkt ";
      $query .= "(namn, beskrivning, bild, pris, antal, tillverkare,
      modell, energiklass, garantitid_manader, egenskap, inkopspris,
      leverantor, aktiv) ";
      $query .= "VALUES ('".$namn."', '".$beskrivning."', '".$bild."',
      ".$pris.", ".$antal.", '".$tillverkare."', '".$modell."',
      '".$energiklass."', ".$garantitid_manader.", '".$egenskap."',
      ".$inkopspris.", ".$leverantor.", ".$aktiv.")";

      mysqli_query($con,$query);

      $last_id = 0;
      if (mysqli_affected_rows($con) == 1) {
        $output = "En ny produkt skapades.<br>";
        $last_id = mysqli_insert_id($con);
      }
      else {
        $output = "En ny produkt kunde inte skapas! <br> Error:" . mysqli_error($con);
      }

      if($last_id !== 0){
        $query  = "INSERT INTO produkt_varugrupp ";
        $query .= "(produkt, varugrupp) ";
        $query .= "VALUES (".$last_id.", ".$varugrupp.") ";

        mysqli_query($con,$query);

        if (mysqli_affected_rows($con) == 1) {
          $output .= " Produkt lades till i varugrupp.<br>";
        }
        else {
          $output .= " Produkt kunde inte läggas till i varugrupp! <br> Error:" . mysqli_error($con);
        }
      }

      mysqli_close($con); // ALWAYS CLOSE THE CONNECTION

    }
  }
  ?>
  <section>
    <h2>Registrera produkt</h2>
    <form class="" action="" method="post">
      <input type="text" name="namn" value="" required="required" placeholder="Namn">
      <br>
      <textarea rows="5" name="beskrivning" value="" placeholder="Beskrivning"></textarea>
      <br>
      <input type="text" name="bild" value="" placeholder="Bild">
      <br>
      <input type="text" name="pris" value="" placeholder="Pris">
      <br>
      <input type="number" name="antal" value="" placeholder="Antal">
      <br>
      <input type="text" name="tillverkare" value="" placeholder="Tillverkare">
      <br>
      <input type="text" name="modell" value="" placeholder="Modell">
      <br>
      <input type="text" name="energiklass" value="" placeholder="Energiklass">
      <br>
      <input type="number" name="garantitid_manader" value="" placeholder="Garantitid (månader)">
      <br>
      <textarea rows="5" name="egenskap" value="" placeholder="Egenskap"></textarea>
      <br>
      <input type="text" name="inkopspris" value="" placeholder="Inköpspris">
      <br>
      <label>Leverantör</label>
      <br>
      <select name="leverantor">
        <option value=""></option>
        <?php
        // START CONNECTION AND GET VAR $con
        require(dirname(dirname(__FILE__))."\includes\db\connect.php");

        $query  = "SELECT * ";
        $query .= "FROM leverantor";
        $result = mysqli_query($con,$query);

        while($row = mysqli_fetch_array($result)) {
          echo '<option value="'.$row['id'] .'">'.$row['namn'].'</option>';
        }
        mysqli_close($con);
        ?>
      </select>
      <br>
      <label>Varugrupp</label>
      <br>
      <select name="varugrupp">
        <option value=""></option>
        <?php
        // START CONNECTION AND GET VARIABLE $con
        require(dirname(dirname(__FILE__))."\includes\db\connect.php");
        $query  = "SELECT * ";
        $query .= "FROM varugrupp ";
        $query .= "WHERE varugrupp IS NULL";
        $result = mysqli_query($con,$query);

        while($row = mysqli_fetch_array($result)) {
          echo '<optgroup value="'.$row['id'].'" label="'.$row['namn'].'">';

          $query  = "SELECT * ";
          $query .= "FROM varugrupp ";
          $query .= "WHERE varugrupp =".$row['id']." ";
          $result2 = mysqli_query($con,$query);

          while($row = mysqli_fetch_array($result2)) {
            echo '<option value="'.$row['id'] .'">'.$row['namn'].'</option>';
          }
          echo '</optgroup>';
        }


        mysqli_close($con);
        ?>
      </select>
      <br>
      <label>Aktiv: <input type="checkbox" name="aktiv" value="1" checked></label>
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
