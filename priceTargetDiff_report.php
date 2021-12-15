<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "/var/www/html/server_creds.php";
$host = 'localhost';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = "SELECT P.firm, T.stock, P.prediction_date, P.price_target, T.sell_price, ABS(P.price_target-T.sell_price)/((T.sell_price+P.price_target)/2)*100 AS percent_difference FROM price_targets P, transactions T WHERE T.Sell_Date = P.Prediction_Date AND T.Stock = P.Stock ORDER BY percent_difference ASC";
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Accuracy of Price Target</title>
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
                <h2>Accuracy of Price Target</h2>
                <table border=1 cellspacing=5 cellpadding=5>
                    <thead>
                        <tr>
                            <th>Firm</th>
                            <th>Stock</th>
                            <th>Date</th>
                            <th>Price Target</th>
                            <th>Actual Price</th>
                            <th>Percent Difference (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $q->fetch()): ?>
                            <tr> 
                                <td><?php echo htmlspecialchars($row['firm']); ?></td>
                                <td><?php echo htmlspecialchars($row['stock']); ?></td>
                                <td><?php echo htmlspecialchars($row['prediction_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['price_target']) ?></td>
                                <td><?php echo htmlspecialchars($row['sell_price']); ?></td>
                                <td><?php echo htmlspecialchars($row['percent_difference']) ?></td>
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