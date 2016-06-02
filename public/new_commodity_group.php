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
      $varugrupp = !empty($_REQUEST['varugrupp']) ? $_REQUEST['varugrupp'] : "NULL";

      // Get mysql connection $con
      require (dirname(dirname(__FILE__))."\includes\db\connect.php");

      $query  = "INSERT INTO varugrupp ";
      $query .= "(namn, beskrivning, varugrupp) ";
      $query .= "VALUES ('".$namn."', '".$beskrivning."', ".$varugrupp.")";

      mysqli_query($con,$query);

      if (mysqli_affected_rows($con) == 1) {
        $output = "En ny varugrupp skapades.";
      }
      else {
        $output = "En ny varugrupp kunde inte skapas! <br> Error:" . mysqli_error($con);
      }

      mysqli_close($con); // ALWAYS CLOSE THE CONNECTION

    }
  }
  ?>
  <section>
    <form class="" action="" method="post">
      <input type="text" name="namn" value="" required="required" placeholder="Namn">
      <textarea rows="6" name="beskrivning" value="" placeholder="Beskrivning"></textarea>
      <select name="varugrupp">
        <option value=""></option>
        <?php
        // START CONNECTION AND GET VAR $con
        require(dirname(dirname(__FILE__))."\includes\db\connect.php");

        $query  = "SELECT * ";
        $query .= "FROM varugrupp";
        $result = mysqli_query($con,$query);

        while($row = mysqli_fetch_array($result)) {
          echo '<option value="'.$row['id'] .'">'.$row['namn'].'</option>';
        }
          mysqli_close($con);
          ?>
        </select>
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
