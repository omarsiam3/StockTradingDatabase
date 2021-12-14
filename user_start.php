<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "/var/www/html/server_creds.php";

$host = 'localhost';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT loginid, lname, fname FROM users';
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
            <h2>Current List of users</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Last name</th>
                        <th>First name</th>
                        <th>Delete?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['loginid']); ?></td>
                            <td><?php echo htmlspecialchars($row['lname']) ?></td>
                            <td><?php echo htmlspecialchars($row['fname']); ?></td>
                            <td><?php echo '<form action="/delete_user.php" method="post"><input type="submit" value="DELETE"><input type="hidden" name="loginid" value="' . htmlspecialchars($row['loginid']) . '"></form>'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><h2>Insert a new user:</h2>
		<form action="/insert_user.php" method="post">
			<table>
				<tr><td>First name:</td><td><input type="text" id="fname" name="fname" value="?"></td></tr>
				<tr><td>Last name:</td><td><input type="text" id="lname" name="lname" value="?"></td></tr>
			</table>
			<input type="submit" value="INSERT">
		</form>
		<br>
		<br><br><br>
    </body>
</div>
</html>
