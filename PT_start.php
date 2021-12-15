<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "/var/www/html/server_creds.php";
$host = 'localhost';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT targetID, Stock, Firm, Price_Target, Prediction_Date FROM price_targets';
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
        <style>

            #Info_Insert {
                float: left;
                display: inline-block;
            }

            #Update {
                float: left;
                display: inline-block;
                margin-left: 100px;
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
                <h2>Price Target Information</h2>
                <table border=1 cellspacing=5 cellpadding=5>
                    <thead>
                        <tr>
                            <th>Price Target ID</th>
                            <th>Stock</th>
                            <th>Firm</th>
                            <th>Price Target</th>
                            <th>Prediction Date</th>
                            <th>Delete?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $q->fetch()): ?>
                            <tr> 
                                <td><?php echo htmlspecialchars($row['targetID']); ?></td>
                                <td><?php echo htmlspecialchars($row['Stock']) ?></td>
                                <td><?php echo htmlspecialchars($row['Firm']); ?></td>
                                <td><?php echo htmlspecialchars($row['Price_Target']) ?></td>
                                <td><?php echo htmlspecialchars($row['Prediction_Date']) ?></td>
                                <td><?php echo '<form action="/delete_PT.php" method="post"><input type="submit" value="DELETE"><input type="hidden" name="targetID" value="' . htmlspecialchars($row['targetID']) . '"></form>'; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div id="Update">
                <br><h2>Insert a new price target:</h2>
                    <form action="/PT_insert.php" method="post">
                        <table>
                            <tr><td>Stock:</td><td><input type="text" id="stock" name="stock" value="?"></td></tr>
                            <tr><td>Firm:</td><td><input type="text" id="firm" name="firm" value="?"></td></tr>
                            <tr><td>Price Target:</td><td><input type="text" id="PT" name="PT" value="?"></td></tr>
                            <tr><td>Prediction Date (YYYY-MM-DD):</td><td><input type="text" id="Date" name="Date" value="?"></td></tr>
                        </table>
                        <input type="submit" value="INSERT">
                    </form>
                <br>
                <br><h2>Update a price target's firm:</h2>
                <form action="/PT_firm_update.php" method="post">
                    <table>
                        <tr><td>Price Target ID:</td><td><input type="text" id="price_target_update" name="price_target_update" value="?"></td></tr>
                        <tr><td>New Firm:</td><td><input type="text" id="firm_update" name="firm_update" value="?"></td></tr>
                    </table>
                    <input type="submit" value="UPDATE">
                </form>
                <br>
                <h2>Update a price target value:</h2>
                <form action="/PT_PT_update.php" method="post">
                    <table>
                        <tr><td>Price Target ID:</td><td><input type="text" id="IDprice_target_update" name="IDprice_target_update" value="?"></td></tr>
                        <tr><td>New Price Target:</td><td><input type="text" id="price_target_updateN" name="price_target_updateN" value="?"></td></tr>
                    </table>
                    <input type="submit" value="UPDATE">
                </form>
                <br>
                <h2>Update a price target's prediction date:</h2>
                <form action="/PT_Date_update.php" method="post">
                    <table>
                        <tr><td>Price Target ID:</td><td><input type="text" id="price_target_upDate" name="price_target_upDate" value="?"></td></tr>
                        <tr><td>New Date (YYYY-MM-DD):</td><td><input type="text" id="upDate" name="upDate" value="?"></td></tr>
                    </table>
                    <input type="submit" value="UPDATE">
                </form>
                <br>
                <br><br><br>
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
            </div>                
        </div>
</body>
</html>
