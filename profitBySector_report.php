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
    $sql = ' SELECT C.sector, SUM((T.Sell_Price-T.Buy_Price)*T.Position_Size) AS total_profit from transactions T, companies C WHERE T.stock=C.stock GROUP BY C.sector ORDER BY total_profit DESC';
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
            <h2>Total Profit of all Users by Sector</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>Sector</th>
                        <th>Total Profit/Loss by Sector ($)</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr> 
                            <td><?php echo htmlspecialchars($row['sector']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_profit']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>