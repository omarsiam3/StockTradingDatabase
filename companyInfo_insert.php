<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'ofs5049';
$password = 'omar431';
$host = 'localhost';
$dbname = 'ofs5049_431W';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP MySQL Query Data Demo</title>
    </head>
    <body>
		<p>
			<?php 
				echo "Inserting new stock: " . $_POST["stock"] . " " . $_POST["company"] . " " . $_POST["sector"] . " " . $_POST["price"] . " " . $_POST["volume"] . " " . $_POST["pe_ratio"] . "..."; 
				$sql = 'INSERT INTO users (lname, fname, loginid) ';
				$sql = $sql . 'VALUES ("'.$_POST["stock"] . '","' . $_POST["company"] . '","' . $_POST["sector"] . '","' . $_POST["price"] . '","' . $_POST["volume"] . '","' . $_POST["pe_ratio"] . '")';
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
