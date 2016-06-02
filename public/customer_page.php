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
    <table>
      <tr>
        <th>
          <a href='products.php?order_by=id<?php echo ($rq_desc == "0") ? '&desc=1' : '&desc=0'; ?>'>
            Id<?php if($rq_order_by == "id"){ echo ($rq_desc == "1") ? '▼' : '▲'; } ?>
          </a>
        </th>
        <th>
          <a href='products.php?order_by=namn<?php echo ($rq_desc == "0") ? '&desc=1' : '&desc=0'; ?>'>
            Namn<?php if($rq_order_by == "namn"){ echo ($rq_desc == "1") ? '▼' : '▲'; } ?>
          </a>
        </th>
        <th>Beskrivning</th>
        <th>Bild</th>
        <th>Pris</th>
        <th>
          <a href='products.php?order_by=antal<?php echo ($rq_desc == "0") ? '&desc=1' : '&desc=0'; ?>'>
            Antal<?php if($rq_order_by == "antal"){ echo ($rq_desc == "1") ? '▼' : '▲'; } ?>
          </a>
        </th>
        <th>Tillverkare</th>
        <th>Modell</th>
        <th>Energiklass</th>
        <th>Garantitid</th>
        <th>Egenskaper</th>
      </tr>
      <?php
      // START CONNECTION AND GET VARIABLE $con
      require(dirname(dirname(__FILE__))."\includes\db\connect.php");

      $query  = "SELECT * ";
      $query .= "FROM produkt ";
      $query .= "WHERE aktiv = 1";
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
        echo "<td>" . $row['egenskaper'] . "</td>";
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
