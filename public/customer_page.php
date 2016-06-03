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
    <h2>Kundsida</h2>
    <form class="" action="" method="post">
      <label>Sök produkter från en tillverkare<input type="text" name="tillverkare_fritext" value="" placeholder="Sök tillverkare"></label>
      <br>
      <label>Sök produkter från en varugrupp<select name="varugrupp">
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
      </select></label>
      <br>
      <input type="submit" name="submit" value="Sök">
    </form>
    <table>
      <tr>
        <th><a href='customer_page.php?order_by=id<?php echo ($rq_desc == "0") ? '&desc=1' : '&desc=0'; ?>'>
          Id<?php if($rq_order_by == "id"){ echo ($rq_desc == "1") ? '▼' : '▲'; } ?>
          </a>
        </th>
        <th><a href='customer_page.php?order_by=namn<?php echo ($rq_desc == "0") ? '&desc=1' : '&desc=0'; ?>'>
          Namn<?php if($rq_order_by == "namn"){ echo ($rq_desc == "1") ? '▼' : '▲'; } ?>
          </a>
        </th>
        <th>Beskrivning</th>
        <th>Bild</th>
        <th><a href='customer_page.php?order_by=pris<?php echo ($rq_desc == "0") ? '&desc=1' : '&desc=0'; ?>'>
          Pris<?php if($rq_order_by == "pris"){ echo ($rq_desc == "1") ? '▼' : '▲'; } ?>
          </a>
        </th>
        <th><a href='customer_page.php?order_by=antal<?php echo ($rq_desc == "0") ? '&desc=1' : '&desc=0'; ?>'>
          Antal&nbsp;i&nbsp;lager<?php if($rq_order_by == "antal"){ echo ($rq_desc == "1") ? '▼' : '▲'; } ?>
          </a>
        </th>
        <th><a href='customer_page.php?order_by=tillverkare<?php echo ($rq_desc == "0") ? '&desc=1' : '&desc=0'; ?>'>
          Tillverkare<?php if($rq_order_by == "tillverkare"){ echo ($rq_desc == "1") ? '▼' : '▲'; } ?>
          </a>
        </th>
        <th>Modell</th>
        <th><a href='customer_page.php?order_by=energiklass<?php echo ($rq_desc == "0") ? '&desc=1' : '&desc=0'; ?>'>
          Energiklass<?php if($rq_order_by == "energiklass"){ echo ($rq_desc == "1") ? '▼' : '▲'; } ?>
          </a></th>
          <th>Garantitid</th>
          <th>Egenskap</th>
        </tr>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $tillverkare_fritext = $_POST['tillverkare_fritext'];
          $varugrupp = $_POST['varugrupp'];

        }
        // START CONNECTION AND GET VARIABLE $con
        require(dirname(dirname(__FILE__))."\includes\db\connect.php");

        $query  = "SELECT * ";
        $query .= "FROM produkt ";
        if(isset($varugrupp) && !empty($varugrupp)){
          $query .= "JOIN produkt_varugrupp ON produkt.id=produkt_varugrupp.produkt ";
        }
        $query .= "WHERE aktiv = 1 ";
        if(isset($varugrupp) && !empty($varugrupp)){
          $query .= "AND produkt_varugrupp.varugrupp = " . $varugrupp . " ";
        }
        if(isset($tillverkare_fritext) && !empty($tillverkare_fritext)){
          $query .= "AND tillverkare LIKE '%" . $tillverkare_fritext . "%' ";
        }
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
          echo "<td><a href='".$row['bild']."'>";
          echo "<img src='".$row['bild']."' style='max-height:50px;'>";
          echo "</a></td>";
          echo "<td>" . $row['pris'] . "</td>";
          echo "<td>" . $row['antal'] . "</td>";
          echo "<td>" . $row['tillverkare'] . "</td>";
          echo "<td>" . $row['modell'] . "</td>";
          echo "<td>" . $row['energiklass'] . "</td>";
          echo "<td>" . $row['garantitid_manader'] . "</td>";
          echo "<td>" . $row['egenskap'] . "</td>";
          echo "</tr>";
        }
        mysqli_close($con);
        ?>
      </table>
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
