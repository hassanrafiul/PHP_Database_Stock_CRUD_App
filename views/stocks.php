<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stocks List</title>
    </head>
    <?php include ('topnavigation.php'); ?>
    <body>
        <table>
            <tr>
                <th>Symbol</th>
                <th>Name</th><!-- comment -->
                <th>Current Price</th><!-- comment -->
                <th>ID</th></tr>
            <?php foreach ($stocks as $stock) : ?>
                <tr>
                    <td><?php echo $stock->get_symbol(); ?></td>
                    <td><?php echo $stock->get_name(); ?></td>
                    <td><?php echo $stock->get_current_price(); ?></td>
                    <td><?php echo $stock->get_id(); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Add Stock or Update Stock</h2>
        <form action ="stocks.php" method="post">
            <label>Symbol:</label>
            <input type="text" name="symbol"/><br>
            <label>Name:</label>
            <input type="text" name="name"/><br>
            <label>Current Price:</label>
            <input type="text" name="current_price"/><br> 
            <input type ="hidden" name ="action" value ="insert_or_update"/>
            <input type="radio" name="insert_or_update" value ="insert" checked>Add</br>
            <input type="radio" name="insert_or_update" value ="update">Update</br>
            <label>&nbsp;</label>
            <input type="submit" value="Submit"/><br>
        </form>


        <h2>Delete Stock</h2>
        <form action ="stocks.php" method="post">
            <label>Symbol:</label>
            <input type="text" name="symbol"/><br>
            <input type ="hidden" name ="action" value ="delete"/>
            <label>&nbsp;</label>
            <input type="submit" value="Delete Stock"/><br>
        </form>
    </body>
    <?php include ('footer.php'); ?>
</html>
