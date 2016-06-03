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
    if (isset($_REQUEST['submit'])) {
      $id = intval($_POST['id']);
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

      $query  = "UPDATE produkt ";
      $query .= "SET namn='".$namn."', beskrivning='".$beskrivning."', bild='".$bild.
      "', pris=".$pris.", antal=".$antal.", tillverkare='".$tillverkare."',
      modell='".$modell."', energiklass='".$energiklass."', garantitid_manader=".$garantitid_manader.
      ", egenskap='".$egenskap."', inkopspris=".$inkopspris.", leverantor=".$leverantor.", aktiv=".$aktiv." ";
      $query .= "WHERE id=".$id;

      mysqli_query($con,"SET FOREIGN_KEY_CHECKS=0"); // DISABLE FOREIGN_KEY_CHECKS
      $result = mysqli_query($con,$query);

      if (mysqli_affected_rows($con) == 1) {
        $output = "Produkt ändrades.<br>";
      }
      else {
        $output = "Produkt kunde inte ändras! <br> Error:" . mysqli_error($con) . "<br>";
      }

      mysqli_query($con,"SET FOREIGN_KEY_CHECKS=1"); // ENABLE FOREIGN_KEY_CHECKS

      if($id !== 0){
        $query  = "DELETE FROM produkt_varugrupp ";
        $query .= "WHERE produkt=".$id;

        mysqli_query($con,$query);

        $query  = "INSERT INTO produkt_varugrupp ";
        $query .= "(produkt, varugrupp) ";
        $query .= "VALUES (".$id.", ".$varugrupp.") ";

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

    $id = intval($_REQUEST['id']);

    // START CONNECTION AND GET VARIABLE $con
    require(dirname(dirname(__FILE__))."\includes\db\connect.php");

    $query  = "SELECT * ";
    $query .= "FROM produkt ";
    $query .= "WHERE produkt.id=".$id." ";
    $result = mysqli_query($con,$query);

    $row = mysqli_fetch_array($result);

    $query  = "SELECT * ";
    $query .= "FROM produkt_varugrupp ";
    $query .= "WHERE produkt=".$id." ";
    $result = mysqli_query($con,$query);

    $row0 = mysqli_fetch_array($result);

    mysqli_close($con);


  ?>
  <section>
    <h2>Ändra produkt</h2>
    <form action="" method="post">
      <input type="hidden" name="id" value="<?php echo $row['id'];?>">
      <label>Namn</label>
      <br>
      <input type="text" name="namn" value="<?php echo $row['namn'];?>" required="required" placeholder="Namn">
      <br>
      <label>Beskrivning</label>
      <br>
      <textarea rows="5" name="beskrivning" value="" placeholder="Beskrivning"><?php echo $row['beskrivning'];?></textarea>
      <br>
      <label>Bild</label>
      <br>
      <input type="text" name="bild" value="<?php echo $row['bild'];?>" placeholder="Bild">
      <br>
      <label>Pris</label>
      <br>
      <input type="text" name="pris" value="<?php echo $row['pris'];?>" placeholder="Pris">
      <br>
      <label>Antal i lager</label>
      <br>
      <input type="number" name="antal" value="<?php echo $row['antal'];?>" placeholder="Antal">
      <br>
      <label>Tillverkare</label>
      <br>
      <input type="text" name="tillverkare" value="<?php echo $row['tillverkare'];?>" placeholder="Tillverkare">
      <br>
      <label>Modell</label>
      <br>
      <input type="text" name="modell" value="<?php echo $row['modell'];?>" placeholder="Modell">
      <br>
      <label>Energiklass</label>
      <br>
      <input type="text" name="energiklass" value="<?php echo $row['energiklass'];?>" placeholder="Energiklass">
      <br>
      <label>Garantitid (månader)</label>
      <br>
      <input type="number" name="garantitid_manader" value="<?php echo $row['garantitid_manader'];?>" placeholder="Garantitid (månader)">
      <br>
      <label>Egenskap</label>
      <br>
      <textarea rows="5" name="egenskap" value="" placeholder="Egenskap"><?php echo $row['egenskap'];?></textarea>
      <br>
      <label>Inköpspris</label>
      <br>
      <input type="text" name="inkopspris" value="<?php echo $row['inkopspris'];?>" placeholder="Inköpspris">
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

        while($row2 = mysqli_fetch_array($result)) {
          echo '<option value="'.$row2['id'].'" '.($row2['id'] == $row['leverantor'] ? 'selected' : '' ).'>'.$row2['namn'].'</option>';
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
        $query  = "SELECT id, namn ";
        $query .= "FROM varugrupp ";
        $query .= "WHERE varugrupp IS NULL";
        $result = mysqli_query($con,$query);

        while($row3 = mysqli_fetch_array($result)) {
          echo '<optgroup value="'.$row3['id'].'" label="'.$row3['namn'].'">';

          $query  = "SELECT id, namn ";
          $query .= "FROM varugrupp ";
          $query .= "WHERE varugrupp =".$row3['id']." ";
          $result2 = mysqli_query($con,$query);

          while($row4 = mysqli_fetch_array($result2)) {
            echo '<option value="'.$row4['id'] .'" '.($row4['id'] == $row0['varugrupp'] ? 'selected' : '').'>'.$row4['namn'].'</option>';
          }
          echo '</optgroup>';
        }

        mysqli_close($con);
        ?>
      </select>
      <br>
      <label>Aktiv: <input type="checkbox" name="aktiv" value="1" <?php echo $row['aktiv'] == 1  ? 'checked' : ''; ?>></label>
      <br>
      <br>
      <input type="submit" name="submit" value="Ändra">
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
