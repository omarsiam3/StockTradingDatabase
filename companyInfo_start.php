<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'ofs5049';
$password = 'omar431';
$host = 'localhost';
$dbname = 'ofs5049_431W';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT stock, company, sector, price, volume, pe_ratio FROM companies';
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
            <h2>Companies Information</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>Stock</th>
                        <th>Company</th>
                        <th>Sector</th>
                        <th>Price</th>
                        <th>Volume</th>
                        <th>PE_Ratio</th>
                        <th>Delete?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr> 
                            <td><?php echo htmlspecialchars($row['stock']); ?></td>
                            <td><?php echo htmlspecialchars($row['company']) ?></td>
                            <td><?php echo htmlspecialchars($row['sector']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']) ?></td>
                            <td><?php echo htmlspecialchars($row['volume']) ?></td>
                            <td><?php echo htmlspecialchars($row['pe_ratio']) ?></td>
                            <td><?php echo '<form action="/delete.php" method="post"><input type="submit" value="DELETE"><input type="hidden" name="stock" value="' . htmlspecialchars($row['stock']) . '"></form>'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><h2>Insert a new company:</h2>
		<form action="/insert.php" method="post">
			<table>
				<tr><td>Stock:</td><td><input type="text" id="stock" name="stock" value="?"></td></tr>
				<tr><td>Company:</td><td><input type="text" id="company" name="company" value="?"></td></tr>
                <tr><td>Sector:</td><td><input type="text" id="sector" name="sector" value="?"></td></tr>
				<tr><td>Price:</td><td><input type="text" id="price" name="price" value="?"></td></tr>
                <tr><td>Volume:</td><td><input type="text" id="volume" name="volume" value="?"></td></tr>
				<tr><td>PE_Ratio:</td><td><input type="text" id="pe_ratio" name="pe_ratio" value="?"></td></tr>
			</table>
			<input type="submit" value="INSERT">
		</form>
		<br>
		<br><br><br>
    </body>
</div>
</html>
