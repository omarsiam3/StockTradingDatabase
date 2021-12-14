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
				echo "Updating price target's date: " . $_POST["price_target_upDate"] . "..."; 
                $PT_ID = $_POST['price_target_upDate']; 
                $date = $_POST['upDate'];  
				$sql = "UPDATE price_targets SET Prediction_Date = '$date' WHERE targetID = '$PT_ID'";
				// $sql = $sql . 'VALUES ("'.$_POST["stock"] . '","' . $_POST["company"] . '","' . $_POST["sector"] . '","' . $_POST["price"] . '","' . $_POST["volume"] . '","' . $_POST["pe_ratio"] . '")';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					echo "New record updated successfully";
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='PT_start.php'
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
