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
				echo "Inserting new transaction: "  . $_POST["userID"] . " " . $_POST["Stock"] . " " . $_POST["Buy_Price"] . " " . $_POST["Sell_Price"] . " " . $_POST["no_of_shares"] . " " . $_POST["Buy_Date"] . " " . $_POST["Sell_Date"] . " " . $_POST["Brokerage"] . " " . $_POST["Exchange"] . "..."; 
				$sql = 'INSERT INTO transactions (userID, Stock, Buy_Price, Sell_Price, no_of_shares, Buy_Date, Sell_Date, Brokerage, Exchange) ';
				$sql = $sql . 'VALUES ("'.$_POST["userID"] . '","' . $_POST["Stock"] . '","' . $_POST["Buy_Price"] . '","' . $_POST["Sell_Price"] . '","' . $_POST["no_of_shares"] . '","' . $_POST["Buy_Date"] . '","' . $_POST["Sell_Date"] . '","' . $_POST["Brokerage"] . '","' . $_POST["Exchange"] . '")';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					echo "\nNew record created successfully";
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='transaction_start.php'
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
