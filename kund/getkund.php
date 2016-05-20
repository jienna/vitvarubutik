<!DOCTYPE html>
<html>
<head>
</head>
<body>

  <?php

  // START CONNECTION AND GET VAR $con
  require(dirname( dirname(__FILE__))."\db\connect.php");

  $id = intval($_GET['id']);
  $namn = $_GET['namn'];
  $email = $_GET['email'];
  $telefonnummer = $_GET['telefonnummer'];
  $gatuadress = $_GET['gatuadress'];
  $stad = $_GET['stad'];
  $postnummer = $_GET['postnummer'];


  $sql="SELECT * FROM kund WHERE id = '".$id."'";
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
    echo "<td>" . $row['postnummer']. "</td>";
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
