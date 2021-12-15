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
				echo "Inserting new brokerage: " . $_POST["brokerage"] . "..."; 
				$sql = 'INSERT INTO brokerages (Brokerage, Buy_Fee, Sell_Fee, Min_Amount) ';
				$sql = $sql . 'VALUES ("'.$_POST["brokerage"] . '","' . $_POST["bFee"] . '","' . $_POST["sFee"] . '","' . $_POST["minAmt"] . '")';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					echo "\nNew record created successfully";
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='brokerage_start.php'
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
