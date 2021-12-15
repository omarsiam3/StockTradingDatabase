<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "/var/www/html/server_creds.php";

$host = 'localhost';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT UserID, lname, fname FROM users';
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

            #List_Insert {
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
            <div id="List_Insert">
                <h2>Current List of users</h2>
                <table border=1 cellspacing=5 cellpadding=5>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Delete?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $q->fetch()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['UserID']); ?></td>
                                <td><?php echo htmlspecialchars($row['fname']) ?></td>
                                <td><?php echo htmlspecialchars($row['lname']); ?></td>
                                <td><?php echo '<form action="/delete_user.php" method="post"><input type="submit" value="DELETE"><input type="hidden" name="UserID" value="' . htmlspecialchars($row['UserID']) . '"></form>'; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div id="Update">
            <br><h2>Insert a new user:</h2>
                <form action="/insert_user.php" method="post">
                    <table>
                        <tr><td>First name:</td><td><input type="text" id="fname" name="fname" value="?"></td></tr>
                        <tr><td>Last name:</td><td><input type="text" id="lname" name="lname" value="?"></td></tr>
                    </table>
                    <input type="submit" value="INSERT">
                </form>
                <br>
                <h2>Update a user's first name:</h2>
                    <form action="/user_fname_update.php" method="post">
                        <table>
                            <tr><td>User ID:</td><td><input type="text" id="UserID_update" name="UserID_update" value="?"></td></tr>
                            <tr><td>New First Name:</td><td><input type="text" id="fname_update" name="fname_update" value="?"></td></tr>
                        </table>
                        <input type="submit" value="UPDATE">
                    </form>
                <br>
                <h2>Update a user's last name:</h2>
                    <form action="/user_lname_update.php" method="post">
                        <table>
                            <tr><td>User ID:</td><td><input type="text" id="UserID_updateL" name="UserID_updateL" value="?"></td></tr>
                            <tr><td>New Last Name:</td><td><input type="text" id="lname_update" name="lname_update" value="?"></td></tr>
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
</div>
</html>
