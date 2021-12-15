<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "/var/www/html/server_creds.php";
$host = 'localhost';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = "SELECT T.userid, U.fname, U.lname, T.stock, T.buy_price, T.sell_price, (((T.sell_price-T.buy_price)/T.buy_price)*100) AS profit_percentage FROM transactions T, users U WHERE T.userid=U.userid ORDER BY profit_percentage DESC";
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
        <style>

            #Info_Insert {
                float: left;
                display: inline-block;
            }

            #buttons {
                float: left;
                display: inline-block;
                margin-left: 100px;
            }

        </style>
    </head>
    <body>
        <div id="container">
            <div id="Info_Insert">
                <h2>Users Profit Percentage Per Trade</h2>
                <table border=1 cellspacing=5 cellpadding=5>
                    <thead>
                        <tr>
                            <th>UserID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Stock</th>
                            <th>Buy Price</th>
                            <th>Sell Price</th>
                            <th>Profit Percentage (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $q->fetch()): ?>
                            <tr> 
                                <td><?php echo htmlspecialchars($row['userid']); ?></td>
                                <td><?php echo htmlspecialchars($row['fname']); ?></td>
                                <td><?php echo htmlspecialchars($row['lname']); ?></td>
                                <td><?php echo htmlspecialchars($row['stock']); ?></td>
                                <td><?php echo htmlspecialchars($row['buy_price']) ?></td>
                                <td><?php echo htmlspecialchars($row['sell_price']); ?></td>
                                <td><?php echo htmlspecialchars($row['profit_percentage']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div id="buttons">
                <form action="/user_start.php">
                    <input type="submit" value="Users">
                </form>
                <br>
                <form action="/transaction_start.php">
                    <input type="submit" value="Transactions">
                </form>
                <br>
                <form action="/PT_start.php">
                    <input type="submit" value="Price Targets">
                </form>
                <br>
                <form action="/companyInfo_start.php">
                    <input type="submit" value="Companies">
                </form>
                <br>
                <form action="/brokerage_start.php">
                    <input type="submit" value="Brokerages">
                </form>
                <br>
                <form action="/fiveTableJoin.php">
                    <input type="submit" value="Additional Transaction Info">
                </form>
                <br>
                <form action="/portfolioProfit_report.php">
                    <input type="submit" value="Portfolio Profit">
                </form>
                <br>
                <form action="/priceTargetDiff_report.php">
                    <input type="submit" value="Price Target Accuracy">
                </form>
                <br>
                <form action="/tradeProfit_report.php">
                    <input type="submit" value="Individual Trade Profit Report">
                </form>
                <br>
                <form action="/profitBySector_report.php">
                    <input type="submit" value="Profit By Sector">
                </form>
                <br>
            </div>
        </div>
    </body>
</html>