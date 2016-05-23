<!DOCTYPE html>
<html>
<head>
</head>
<body>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {   //something posted



    // START CONNECTION AND GET VAR $con
    require(dirname( dirname(__FILE__))."\db\connect.php");

    $id = intval($_POST['id']);
    $namn = $_POST['namn'];
    $email = $_POST['email'];
    $telefonnummer = $_POST['telefonnummer'];
    $gatuadress = $_POST['gatuadress'];
    $stad = $_POST['stad'];
    $postnummer = $_POST['postnummer'];





    if (isset($_POST["btnUpdate"])){
      $sql=
      "UPDATE kund SET name='".$namn."' WHERE id=".$id;
      $result = mysqli_query($con,$sql);
    }
    else if (isset($_POST["btnDelete"])){
      // $sql=
      // "DELETE kund SET name='".$namn."' WHERE id=".$id;
      // $result = mysqli_query($con,$sql);
    }
  }
  // while($row = mysqli_fetch_array($result)) { }
  mysqli_close($con);
  ?>
</body>
</html>
