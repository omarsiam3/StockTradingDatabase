<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "/var/www/html/server_creds.php";

$host = 'localhost';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT transactionID, UserID, Stock, Buy_Price, Sell_Price, no_of_shares, Buy_Date, Sell_Date, Brokerage, Exchange FROM transactions';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP MySQL Query Data Demo</title>
    </head>
    <body>
        <div id="container">
            <h2>Current List of Transactions</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>User ID</th>
                        <th>Stock</th>
                        <th>Buy Price</th>
                        <th>Sell Price</th>
                        <th>Number of Shares</th>
                        <th>Buy Date</th>
                        <th>Sell Date</th>
                        <th>Brokerage</th>
                        <th>Exchange</th>
                        <th>Delete?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['transactionID']); ?></td>
                            <td><?php echo htmlspecialchars($row['UserID']); ?></td>
                            <td><?php echo htmlspecialchars($row['Stock']) ?></td>
                            <td><?php echo htmlspecialchars($row['Buy_Price']); ?></td>
                            <td><?php echo htmlspecialchars($row['Sell_Price']); ?></td>
                            <td><?php echo htmlspecialchars($row['no_of_shares']); ?></td>
                            <td><?php echo htmlspecialchars($row['Buy_Date']); ?></td>
                            <td><?php echo htmlspecialchars($row['Sell_Date']); ?></td>
                            <td><?php echo htmlspecialchars($row['Brokerage']); ?></td>
                            <td><?php echo htmlspecialchars($row['Exchange']); ?></td>
                            <td><?php echo '<form action="/delete_transaction.php" method="post"><input type="submit" value="DELETE"><input type="hidden" name="transactionID" value="' . htmlspecialchars($row['transactionID']) . '"></form>'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><h2>Insert a new user:</h2>
		<form action="/insert_transaction.php" method="post">
			<table>
				<tr><td>User ID:</td><td><input type="text" id="userID" name="userID" value="?"></td></tr>
                <tr><td>Stock:</td><td><input type="text" id="Stock" name="Stock" value="?"></td></tr>
				<tr><td>Buy Price:</td><td><input type="text" id="Buy_Price" name="Buy_Price" value="?"></td></tr>
                <tr><td>Sell Price:</td><td><input type="text" id="Sell_Price" name="Sell_Price" value="?"></td></tr>
				<tr><td>Number of Shares:</td><td><input type="text" id="no_of_shares" name="no_of_shares" value="?"></td></tr>
                <tr><td>Buy Date:</td><td><input type="text" id="Buy_Date" name="Buy_Date" value="?"></td></tr>
				<tr><td>Sell Date:</td><td><input type="text" id="Sell_Date" name="Sell_Date" value="?"></td></tr>
                <tr><td>Brokerage:</td><td><input type="text" id="Brokerage" name="Brokerage" value="?"></td></tr>
				<tr><td>Exchange:</td><td><input type="text" id="Exchange" name="Exchange" value="?"></td></tr>
			</table>
			<input type="submit" value="INSERT">
		</form>
		<br>
		<br><br><br>
    </body>
</div>
</html>
