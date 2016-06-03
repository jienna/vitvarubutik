<?php
// Start the session
session_start();

// Default värde för kolumnsortering
$rq_desc = '0';

// Kontrollera att samma kolumn försöker sorteras...
if(!((isset($_SESSION["order_by"]) && isset($_REQUEST["order_by"])) && ($_SESSION["order_by"] != $_REQUEST["order_by"])))
{
  // ...innan det nya värdet för $rq_desc sätts.
  $rq_desc = (isset($_REQUEST["desc"])) ? $_REQUEST["desc"] : '';
}

$rq_order_by = (isset($_REQUEST["order_by"]) && !empty($_REQUEST["order_by"])) ? $_REQUEST["order_by"] : '';

// För att spara vilken kolumn som sorterades.
$_SESSION["order_by"] = (isset($_REQUEST["order_by"]) && !empty($_REQUEST["order_by"])) ? $_REQUEST["order_by"] : '';

?>
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
  <section>
    <h2>Leverantörer</h2>
    <table>
      <tr>
        <th>
          <a href='suppliers.php?order_by=id<?php echo ($rq_desc == "0") ? '&desc=1' : '&desc=0'; ?>'>
            Id<?php if($rq_order_by == "id"){ echo ($rq_desc == "1") ? '▼' : '▲'; } ?>
          </a>
        </th>
        <th>
          <a href='suppliers.php?order_by=namn<?php echo ($rq_desc == "0") ? '&desc=1' : '&desc=0'; ?>'>
            Namn<?php if($rq_order_by == "namn"){ echo ($rq_desc == "1") ? '▼' : '▲'; } ?>
          </a>
        </th>
        <th>Beskrivning</th>
        <th>Telefonnummer</th>
        <th>Email</th>
        <th>Gatuadress</th>
        <th>Stad</th>
        <th>Postnummer</th>
        <th>Land</th>
        <th>
          <a href='suppliers.php?order_by=aktiv<?php echo ($rq_desc == "0") ? '&desc=1' : '&desc=0'; ?>'>
            Aktiv<?php if($rq_order_by == "aktiv"){ echo ($rq_desc == "1") ? '▼' : '▲'; } ?>
          </a>
        </th>
      </tr>
      <?php
      // START CONNECTION AND GET VARIABLE $con
      require(dirname(dirname(__FILE__))."\includes\db\connect.php");

      $query  = "SELECT * ";
      $query .= "FROM leverantor ";
      if(!empty($rq_order_by)){
        $query .= "ORDER BY " . $rq_order_by . " ";
        if (!empty($rq_desc) && $_REQUEST["desc"] == "1") {
          $query .= "DESC ";
        }
      }

      $result = mysqli_query($con,$query);

      while($row = mysqli_fetch_array($result)) {

        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['namn'] . "</td>";
        echo "<td>" . $row['beskrivning'] . "</td>";
        echo "<td>" . $row['telefonnummer'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['gatuadress'] . "</td>";
        echo "<td>" . $row['stad'] . "</td>";
        echo "<td>" . $row['postnummer'] . "</td>";
        echo "<td>" . $row['land'] . "</td>";
        echo "<td>" . $row['aktiv'] . "</td>";
        echo "<td>";
        echo '<form action="delete_supplier.php" method="post">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<input type="submit" name="btnDelete" value="Radera" onclick="return confirm(\'Säker?\')">';
        if($row['aktiv'] == "1"){
          echo '<input type="submit" name="btnDeactivate" value="Inaktivera">';
        }
        else if ($row['aktiv'] == "0") {
          echo '<input type="submit" name="btnActivate" value="Aktivera">';
        }
        echo '</form>';
        echo "</td>";
        echo "</tr>";
      }
      mysqli_close($con);
      ?>
    </table>
    <a href="new_supplier.php">Skapa en ny leverantör</a>
    <p>
      <?php if (isset($output) && !empty($output)) {
        echo $output;
      } ?>
    </p>
  </section>
  <footer>
  </footer>
</body>
</html>
