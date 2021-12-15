<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "/var/www/html/server_creds.php";
$host = 'localhost';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT Brokerage, Buy_Fee, Sell_Fee, Min_Amount FROM brokerages';
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

        </style>
    </head>
    <body>
        <div id="container">
            <div id="Info_Insert">
                <h2>Price Target Information</h2>
                <table border=1 cellspacing=5 cellpadding=5>
                    <thead>
                        <tr>
                            <th>Brokerage</th>
                            <th>Buy Fee</th>
                            <th>Sell Fee</th>
                            <th>Min Amount</th>
                            <th>Delete?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $q->fetch()): ?>
                            <tr> 
                                <td><?php echo htmlspecialchars($row['Brokerage']); ?></td>
                                <td><?php echo htmlspecialchars($row['Buy_Fee']) ?></td>
                                <td><?php echo htmlspecialchars($row['Sell_Fee']); ?></td>
                                <td><?php echo htmlspecialchars($row['Min_Amount']) ?></td>
                                <td><?php echo '<form action="/delete_broker.php" method="post"><input type="submit" value="DELETE"><input type="hidden" name="Brokerage" value="' . htmlspecialchars($row['Brokerage']) . '"></form>'; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <br><h2>Insert a new price target:</h2>
                    <form action="/broker_insert.php" method="post">
                        <table>
                            <tr><td>Brokerage:</td><td><input type="text" id="brokerage" name="brokerage" value="?"></td></tr>
                            <tr><td>Buy Fee:</td><td><input type="text" id="bFee" name="bFee" value="?"></td></tr>
                            <tr><td>Sell Fee:</td><td><input type="text" id="sFee" name="sFee" value="?"></td></tr>
                            <tr><td>Minimum Amount:</td><td><input type="text" id="minAmt" name="minAmt" value="?"></td></tr>
                        </table>
                        <input type="submit" value="INSERT">
                    </form>
                <br>
            </div>
            <div id="Update">
                <br><h2>Update a brokerage's buy fee:</h2>
                <form action="/broker_bFee_update.php" method="post">
                    <table>
                        <tr><td>Brokerage:</td><td><input type="text" id="broker_bFee_update" name="broker_bFee_update" value="?"></td></tr>
                        <tr><td>New Buy Fee:</td><td><input type="text" id="buy_fee_update" name="buy_fee_update" value="?"></td></tr>
                    </table>
                    <input type="submit" value="UPDATE">
                </form>
                <br>
                <h2>Update a brokerage's sell fee:</h2>
                <form action="/broker_sFee_update.php" method="post">
                    <table>
                        <tr><td>Brokerage:</td><td><input type="text" id="broker_sFee_update" name="broker_sFee_update" value="?"></td></tr>
                        <tr><td>New Sell Fee:</td><td><input type="text" id="sell_fee_update" name="sell_fee_update" value="?"></td></tr>
                    </table>
                    <input type="submit" value="UPDATE">
                </form>
                <br>
                <h2>Update a price target's prediction date:</h2>
                <form action="/broker_minAmt_update.php" method="post">
                    <table>
                        <tr><td>Brokerage:</td><td><input type="text" id="broker_minAmt_update" name="broker_minAmt_update" value="?"></td></tr>
                        <tr><td>Minimum Amount:</td><td><input type="text" id="minAmt" name="minAmt" value="?"></td></tr>
                    </table>
                    <input type="submit" value="UPDATE">
                </form>
                <br>
                <br><br><br>
            </div>
        </div>
</body>
</html>
