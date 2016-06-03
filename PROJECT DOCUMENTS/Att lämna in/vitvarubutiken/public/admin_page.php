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
    <h2>Administration</h2>
    <ul>
      <li><a href="new_customer.php">Lägg till en ny kund</a></li>
      <li><a href="new_purchase.php">Registrera ett nytt köp</a></li>
      <li><a href="product_customers.php">Lista kunder som köpt en produkt</a></li>
      <li><a href="products.php">Visa produkter (Skapa/Ändra/Radera/Inaktivera)</a></li>
      <li><a href="suppliers.php">Visa leverantörer (Skapa/Radera/Inaktivera)</a></li>
      <li><a href="commodity_groups.php">Visa varugrupper (Skapa/Radera)</a></li>
    </ul>
  </section>
  <footer>

  </footer>
</body>
</html>
