<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "/var/www/html/server_creds.php";
$host = 'localhost';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP MySQL Query Data Demo</title>
    </head>
    <body>
		<p>
			<?php 
				echo "Updating company's price: " . $_POST["stock_price_update"] . "..."; 
                $stock = $_POST['stock_price_update']; 
                $price = $_POST['price_update'];  
				$sql = "UPDATE companies SET Price = $price WHERE Stock = '$stock'";
				// $sql = $sql . 'VALUES ("'.$_POST["stock"] . '","' . $_POST["company"] . '","' . $_POST["sector"] . '","' . $_POST["price"] . '","' . $_POST["volume"] . '","' . $_POST["pe_ratio"] . '")';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					echo "New record created successfully";
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='companyInfo_start.php'
					}, 3000);
				</script>
			<?php
				} catch(PDOException $e) {
					echo $sql . "<br>" . $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
