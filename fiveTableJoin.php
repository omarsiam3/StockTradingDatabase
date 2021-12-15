<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "/var/www/html/server_creds.php";
$host = 'localhost';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT U.fname, U.lname, B.brokerage, B.Buy_Fee, B.Sell_Fee, T.exchange, E.country, T.stock, C.Sector, T.Buy_Date, T.Sell_Date, T.no_of_shares FROM transactions T, brokerages B, exchanges E, users U, companies C WHERE T.UserID = U.UserID AND T.Exchange = E.Exchange AND T.Brokerage = B.Brokerage AND T.Stock = C.Stock';
    #$sql = 'SELECT U.fname, U.lname, T.stock, B.brokerage, T.exchange, E.country, (T.Sell_Price-T.Buy_Price - ((T.no_of_shares*B.Buy_Fee)+(T.no_of_shares*B.Sell_Fee))) AS profit FROM transactions T, brokerages B, exchanges E, users U, companies C WHERE T.UserID = U.UserID AND T.Exchange = E.Exchange AND T.Brokerage = B.Brokerage AND T.Transactions = C.Companies';
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
                <h2>Additional Transaction Data</h2>
                <table border=1 cellspacing=5 cellpadding=5>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Brokerage</th>
                            <th>Buy Fee</th>
                            <th>Sell Fee</th>
                            <th>Exchange</th>
                            <th>Exchange Country</th>
                            <th>Stock</th>
                            <th>Sector</th>
                            <th>Buy Date</th>
                            <th>Sell Date</th>
                            <th>Number of Shares</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $q->fetch()): ?>
                            <tr> 
                                <td><?php echo htmlspecialchars($row['fname']); ?></td>
                                <td><?php echo htmlspecialchars($row['lname']); ?></td>
                                <td><?php echo htmlspecialchars($row['brokerage']) ?></td>
                                <td><?php echo htmlspecialchars($row['Buy_Fee']); ?></td>
                                <td><?php echo htmlspecialchars($row['Sell_Fee']) ?></td>
                                <td><?php echo htmlspecialchars($row['exchange']); ?></td>
                                <td><?php echo htmlspecialchars($row['country']) ?></td>
                                <td><?php echo htmlspecialchars($row['stock']); ?></td>
                                <td><?php echo htmlspecialchars($row['Sector']) ?></td>
                                <td><?php echo htmlspecialchars($row['Buy_Date']); ?></td>
                                <td><?php echo htmlspecialchars($row['Sell_Date']) ?></td>
                                <td><?php echo htmlspecialchars($row['no_of_shares']); ?></td>
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