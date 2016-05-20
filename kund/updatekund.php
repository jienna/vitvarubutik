<!DOCTYPE html>
<html>
<head>

</head>
<body>

  <?php

  require $_SERVER[‘DOCUMENT_ROOT’]."/db/connect.php";

  $charset = "utf8";
  $q = intval($_GET['q']);

  $con = mysqli_connect('localhost','root','','vitvarubutik');
  if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
  }

  // -------------------------
  // SET CHARSET
  // -------------------------
  if (!mysqli_set_charset($con, $charset))
  {
    die('Det går inte att ställa in databasanslutningens kodning.');
  }
  // -------------------------

  mysqli_select_db($con,"vitvarubutik");
  $sql="SELECT * FROM kund WHERE id = '".$q."'";
  $result = mysqli_query($con,$sql);

  echo "<table>
  <tr>
  <th>Id</th>
  <th>Namn</th>
  <th>Email</th>
  <th>Telefonnummer</th>
  <th>Gatuadress</th>
  <th>Stad</th>
  <th>Postnummer</th>
  </tr>";
  while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['namn'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['telefonnummer'] . "</td>";
    echo "<td>" . $row['gatuadress'] . "</td>";
    echo "<td>" . $row['stad'] . "</td>";
    echo "<td>" . $row['postnummer'] . "</td>";
    echo "</tr>";

    echo "</table>";

    echo '<form>';
    echo '<div>';
    echo '<input type="button" name="update" value="Ändra" onclick="updateKund('.$row['id'].')">';
    echo '<input type="button" name="delete" value="Tabort" onclick="deleteKund('.$row['id'].')">';
    echo '</div>';
    echo '</form>';
  }


  mysqli_close($con);
  ?>
</body>
</html>
