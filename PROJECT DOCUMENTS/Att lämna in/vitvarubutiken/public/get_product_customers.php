<!DOCTYPE html>
<html>
<head>
</head>
<body>

  <?php
  // START CONNECTION AND GET VARIABLE $con
  require(dirname(dirname(__FILE__))."\includes\db\connect.php");

  $q = intval($_GET['q']);

  $query  = "SELECT kop.datum, kop.antal, kund.namn, kund.email, kund.telefonnummer, kund.gatuadress, kund.stad, kund.postnummer ";
  $query .= "FROM ((kund JOIN kop ON kund.id = kop.kund) JOIN produkt ON kop.produkt = produkt.id) ";
  $query .= "WHERE produkt.id =" . $q . " ";
  $query .= "ORDER BY kop.datum DESC ";
  $result = mysqli_query($con,$query);

  if(mysqli_num_rows($result) != 0) {
    echo "<table>
    <tr>
    <th>Datum</th>
    <th>Antal</th>
    <th>Namn</th>
    <th>Email</th>
    <th>Telefonnummer</th>
    <th>Gatuadress</th>
    <th>Stad</th>
    <th>Postnummer</th>
    </tr>";
    while($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td>" . $row['datum'] . "</td>";
      echo "<td>" . $row['antal'] . "</td>";
      echo "<td>" . $row['namn'] . "</td>";
      echo "<td>" . $row['email'] . "</td>";
      echo "<td>" . $row['telefonnummer'] . "</td>";
      echo "<td>" . $row['gatuadress'] . "</td>";
      echo "<td>" . $row['stad'] . "</td>";
      echo "<td>" . $row['postnummer']. "</td>";
      echo "</tr>";
    }
    echo "</table>";
  }
  else {
    echo "Inga kunder har köpt denna produkten än.";
  }
  mysqli_close($con);
  ?>
</body>
</html>
