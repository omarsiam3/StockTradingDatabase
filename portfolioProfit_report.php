<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "/var/www/html/server_creds.php";
$host = 'localhost';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT T.userid, U.fname, U.lname, SUM((T.Sell_Price-T.Buy_Price)*T.no_of_shares) AS total_profit from transactions T, users U WHERE T.userid = U.userid GROUP BY userid ORDER BY Total_Profit DESC';
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
                <h2>Users' Portfolio Profit Percentage</h2>
                <table border=1 cellspacing=5 cellpadding=5>
                    <thead>
                        <tr>
                            <th>UserID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Total Profit/Loss ($)</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $q->fetch()): ?>
                            <tr> 
                                <td><?php echo htmlspecialchars($row['userid']); ?></td>
                                <td><?php echo htmlspecialchars($row['fname']); ?></td>
                                <td><?php echo htmlspecialchars($row['lname']); ?></td>
                                <td><?php echo htmlspecialchars($row['total_profit']); ?></td>
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