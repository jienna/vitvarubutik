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
        <th>Id</th>
        <th>Namn</th>
        <th>Beskrivning</th>
        <th>Bild</th>
        <th>Pris</th>
        <th>Antal</th>
        <th>Tillverkare</th>
        <th>Modell</th>
        <th>Energiklass</th>
        <th>Garantitid</th>
        <th>Egenskaper</th>
        <th>Inköpspris</th>
        <th>Leverantor</th>
        <th>Aktiv</th>
        <th>Uppdaterad</th>
      </tr>
      <?php
      // START CONNECTION AND GET VAR $con
      require(dirname(dirname(__FILE__))."\includes\db\connect.php");

      $query  = "SELECT * ";
      $query .= "FROM produkt";
      $result = mysqli_query($con,$query);

      while($row = mysqli_fetch_array($result)) {

        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['namn'] . "</td>";
        echo "<td>" . $row['beskrivning'] . "</td>";
        echo "<td>" . $row['bild'] . "</td>";
        echo "<td>" . $row['pris'] . "</td>";
        echo "<td>" . $row['antal'] . "</td>";
        echo "<td>" . $row['tillverkare'] . "</td>";
        echo "<td>" . $row['modell'] . "</td>";
        echo "<td>" . $row['energiklass'] . "</td>";
        echo "<td>" . $row['garantitid_manader'] . "</td>";
        echo "<td>" . $row['egenskaper'] . "</td>";
        echo "<td>" . $row['inkopspris'] . "</td>";
        echo "<td>" . $row['leverantor'] . "</td>";
        echo "<td>" . $row['aktiv'] . "</td>";
        echo "<td>" . $row['uppdaterad'] . "</td>";
        echo "<td>";
        echo '<form action="delete_product.php" method="post">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<input type="submit" name="btnDelete" value="Radera">';
        echo '</form>';
        echo "</td>";
        echo "</tr>";
      }
      mysqli_close($con);
      ?>
    </table>
    <a href="new_product.php">Skapa en ny produkt</a>
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
