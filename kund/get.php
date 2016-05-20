<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

  <?php

  // START CONNECTION AND GET VAR $con
  require(dirname( dirname(__FILE__))."\db\connect.php");

  $q = intval($_GET['q']);

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
    echo "<td>" . $row['postnummer']. "</td>";
    echo "</tr>";

    echo "</table>";
  }


  mysqli_close($con);
  ?>
</body>
</html>
