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
    $sql = 'SELECT T.userid, U.fname, U.lname, T.stock, B.brokerage, T.exchange, E.country ((position_size*buy_fee)+(position_size*sell_fee)) AS total_fees, E.country FROM transactions T, brokerages B, exchanges E, users U, companies C WHERE T.userid = U.users AND T.exchange = E.exchange';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>User Profits</title>
    </head>
    <body>
        <div id="container">
            <h2>Users Profit Percentage Per Trade</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Stock</th>
                        <th>Brokerage</th>
                        <th>Exchange</th>
                        <th>Exchange Country</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr> 
                            <td><?php echo htmlspecialchars($row['userid']); ?></td>
                            <td><?php echo htmlspecialchars($row['stock']); ?></td>
                            <td><?php echo htmlspecialchars($row['fname']); ?></td>
                            <td><?php echo htmlspecialchars($row['lname']); ?></td>
                            <td><?php echo htmlspecialchars($row['brokerage']) ?></td>
                            <td><?php echo htmlspecialchars($row['exchange']); ?></td>
                            <td><?php echo htmlspecialchars($row['country']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>