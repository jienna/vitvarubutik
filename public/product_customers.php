<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Vitvarubutik</title>
  <?php include dirname(dirname(__FILE__)).'\includes\stylesheets.php'; ?>
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <script>
  function showCustomers(str) {
    if (str == "") {
      document.getElementById("result").innerHTML = "Ingen produkt vald.";
      return;
    } else {
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("result").innerHTML = xmlhttp.responseText;
        }
      };
      xmlhttp.open("GET","get_product_customers.php?q="+str,true);
      xmlhttp.send();
    }
  }
  </script>
</head>
<body>
  <header>
    <h1>Lars Bloms vitvarubutik</h1>
    <?php include dirname(dirname(__FILE__)).'\includes\menu.php';?>
  </header>
  <section>
    <form>
      <div>
        <label>Produkter:</label>
        <select name="produkt" onchange="showCustomers(this.value)">
          <option value="">Välj en produkt</option>
          <?php
          // START CONNECTION AND GET VARIABLE $con
          require(dirname(dirname(__FILE__))."\includes\db\connect.php");

          $query  = "SELECT id, namn ";
          $query .= "FROM produkt ";
          $query .= "ORDER BY id";

          $result = mysqli_query($con,$query);

          while($row = mysqli_fetch_array($result)) {
            echo '<option value="'.$row['id'].'">'.$row['id']." - ".$row['namn'].'</option>';
          }
          mysqli_close($con);
          ?>
        </select>
      </div>
    </form>
    <br>
    <div id="result"></div>
    <div id="message"></div>
  </section>
  <footer>

  </footer>
</body>
</html>
