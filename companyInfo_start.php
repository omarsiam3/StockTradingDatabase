<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "/var/www/html/server_creds.php";
$host = 'localhost';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT stock, company, sector, price, volume, pe_ratio FROM companies';
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
                <h2>Companies Information</h2>
                <table border=1 cellspacing=5 cellpadding=5>
                    <thead>
                        <tr>
                            <th>Stock</th>
                            <th>Company</th>
                            <th>Sector</th>
                            <th>Price</th>
                            <th>Volume</th>
                            <th>PE_Ratio</th>
                            <th>Delete?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $q->fetch()): ?>
                            <tr> 
                                <td><?php echo htmlspecialchars($row['stock']); ?></td>
                                <td><?php echo htmlspecialchars($row['company']) ?></td>
                                <td><?php echo htmlspecialchars($row['sector']); ?></td>
                                <td><?php echo htmlspecialchars($row['price']) ?></td>
                                <td><?php echo htmlspecialchars($row['volume']) ?></td>
                                <td><?php echo htmlspecialchars($row['pe_ratio']) ?></td>
                                <td><?php echo '<form action="/delete_company.php" method="post"><input type="submit" value="DELETE"><input type="hidden" name="stock" value="' . htmlspecialchars($row['stock']) . '"></form>'; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <br><h2>Insert a new company:</h2>
                    <form action="/companyInfo_insert.php" method="post">
                        <table>
                            <tr><td>Stock:</td><td><input type="text" id="stock" name="stock" value="?"></td></tr>
                            <tr><td>Company:</td><td><input type="text" id="company" name="company" value="?"></td></tr>
                            <tr><td>Sector:</td><td><input type="text" id="sector" name="sector" value="?"></td></tr>
                            <tr><td>Price:</td><td><input type="text" id="price" name="price" value="?"></td></tr>
                            <tr><td>Volume:</td><td><input type="text" id="volume" name="volume" value="?"></td></tr>
                            <tr><td>PE_Ratio:</td><td><input type="text" id="pe_ratio" name="pe_ratio" value="?"></td></tr>
                        </table>
                        <input type="submit" value="INSERT">
                    </form>
                <br>
            </div>
            <div id="Update">
                <br><h2>Update a company's stock price:</h2>
                <form action="/company_price_update.php" method="post">
                    <table>
                        <tr><td>Stock:</td><td><input type="text" id="stock_price_update" name="stock_price_update" value="?"></td></tr>
                        <tr><td>New Price:</td><td><input type="text" id="price_update" name="price_update" value="?"></td></tr>
                    </table>
                    <input type="submit" value="UPDATE_PRICE ">
                </form>
                <br>
                <h2>Update a company's volume:</h2>
                <form action="/company_volume_update.php" method="post">
                    <table>
                        <tr><td>Stock:</td><td><input type="text" id="stock_volume_update" name="stock_volume_update" value="?"></td></tr>
                        <tr><td>New Volume:</td><td><input type="text" id="volume_update" name="volume_update" value="?"></td></tr>
                    </table>
                    <input type="submit" value="UPDATE_VOLUME">
                </form>
                <br>
                <h2>Update a company's PE Ratio:</h2>
                <form action="/company_PE_update.php" method="post">
                    <table>
                        <tr><td>Stock:</td><td><input type="text" id="stock_PE_update" name="stock_PE_update" value="?"></td></tr>
                        <tr><td>New PE Ratio:</td><td><input type="text" id="PE_update" name="PE_update" value="?"></td></tr>
                    </table>
                    <input type="submit" value="UPDATE_PE">
                </form>
                <br>
                <br><br><br>
            </div>
        </div>
</body>
</html>
