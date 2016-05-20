<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Vitvarubutik</title>
  <link rel="stylesheet" href="css/styles.css">
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <script>
  function showUser(str) {
    if (str == "") {
      document.getElementById("result").innerHTML = "Ingen kund vald.";
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
      xmlhttp.open("GET","getkund.php?q="+str,true);
      xmlhttp.send();
    }
  }

  function updateKund(str) {
    if (str == "") {
      document.getElementById("result").innerHTML = "Ingen kund vald.";
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
          document.getElementById("message").innerHTML = xmlhttp.responseText;
        }
      };
      xmlhttp.open("GET","updatekund.php?q="+str,true);
      xmlhttp.send();
    }
  }

  function deleteKund(str) {
    if (str == "") {
      document.getElementById("result").innerHTML = "Ingen kund vald.";
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
      xmlhttp.open("GET","getkund.php?q="+str,true);
      xmlhttp.send();
    }
  }
  </script>
</head>
<body>


  <form>
    <div>
      <label>Kunder:</label>
      <select name="kund" onchange="showUser(this.value)">
        <option value="">Välj en kund</option>
        <?php
        $charset = "utf8";

        // -------------------------
        // CONNECT TO DB
        // -------------------------
        $con = mysqli_connect('localhost','root','','vitvarubutik');
        if (!$con) {
          die('Could not connect: ' . mysqli_error($con));
        }
        // -------------------------


        // -------------------------
        // SET CHARSET
        // -------------------------
        if (!mysqli_set_charset($con, $charset))
        {
          die('Det går inte att ställa in databasanslutningens kodning.');
        }
        // -------------------------

        mysqli_select_db($con,"vitvarubutik");
        $sql="SELECT * FROM kund";
        $result = mysqli_query($con,$sql);

        while($row = mysqli_fetch_array($result)) {
          echo '<option value="'.$row['id'].'">'.$row['namn'].'</option>';
        }
        ?>
      </select>
    </div>
  </form>
  <br>
  <div id="result"><strong>Kund info visas här...</strong></div>
  <div id="message"></div>

</body>
</html>
