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
        <th>Varugrupp</th>
      </tr>
      <?php
      // START CONNECTION AND GET VAR $con
      require(dirname(dirname(__FILE__))."\includes\db\connect.php");

      $query  = "SELECT * ";
      $query .= "FROM varugrupp";
      $result = mysqli_query($con,$query);

      while($row = mysqli_fetch_array($result)) {

        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['namn'] . "</td>";
        echo "<td>" . $row['beskrivning'] . "</td>";
        echo "<td>" . $row['varugrupp'] . "</td>";
        echo "<td>";
        echo '<form action="delete_commodity_group.php" method="post">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<input type="submit" name="btnDelete" value="Radera" onclick="return confirm(\'Säker?\')">';
        echo '</form>';
        echo "</td>";
        echo "</tr>";
      }
      mysqli_close($con);
      ?>
    </table>
    <a href="new_commodity_group.php">Skapa en ny varugrupp</a>
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
