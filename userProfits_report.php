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
    $sql = 'SELECT userid, buy_price, sell_price, (((sell_price-buy_price)/buy_price)*100) AS profit_percentage FROM transactions ORDER BY profit_percentage DESC';
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
            <h2>Users Profit Percentage</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>UserID</th>
                        <th>Buy Price</th>
                        <th>Sell Price</th>
                        <th>Profit Percentage (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr> 
                            <td><?php echo htmlspecialchars($row['userid']); ?></td>
                            <td><?php echo htmlspecialchars($row['buy_price']) ?></td>
                            <td><?php echo htmlspecialchars($row['sell_price']); ?></td>
                            <td><?php echo htmlspecialchars($row['profit_percentage']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>