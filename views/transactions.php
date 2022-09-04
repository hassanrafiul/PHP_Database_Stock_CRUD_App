<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Transactions List</title>
    </head>
    <?php include ('topnavigation.php'); ?>
    </br>
    <body>
        <table>
            <tr>
                <th>Id</th>
                <th>User Id</th>
                <th>Stock Id</th><!-- comment -->
                <th>Quantity</th><!-- comment -->
                <th>Price</th><!-- comment -->
                <th>Timestamp</th><!-- comment -->
                
            </tr>
            <?php foreach ($transactions as $transaction) : ?>
                <tr>
                    <td><?php echo $transaction->get_id(); ?></td>
                    <td><?php echo $transaction->get_user_id(); ?></td>
                    <td><?php echo $transaction->get_stock_id(); ?></td>
                    <td><?php echo $transaction->get_quantity(); ?></td>
                    <td><?php echo $transaction->get_price(); ?></td>
                    <td><?php echo $transaction->get_timestamp(); ?></td>                    
                    
                </tr>
            <?php endforeach; ?>
        </table>
        </br>
        <h2>Add Transaction </h2>
        <form action ="transactions.php" method="post">
            <label>User ID:</label>
            <input type="text" name="user_id"/><br>
            <label>Stock ID:</label>
            <input type="text" name="stock_id"/><br>
            <label>Quantity:</label>
            <input type="text" name="quantity"/><br> 
            <input type="hidden" name ="action" value ="insert"/>
            <label>&nbsp;</label>
            <input type="submit" value="ADD Transaction"/><br>
        </form>
        </br>
        <h2>Update Transaction </h2>
        <form action ="transactions.php" method="post">
            <label>User ID:</label>
            <input type="text" name="user_id"/><br>
            <label>Stock ID:</label>
            <input type="text" name="stock_id"/><br>
            <label>Quantity:</label>
            <input type="text" name="quantity"/><br> 
            <label>Price:</label>
            <input type="text" name="price"/><br> 
            <label>ID:</label>
            <input type="text" name="id"/><br>
            <input type="hidden" name="action" value ="update"/>
            <label>&nbsp;</label>
            <input type="submit" value="UPDATE Transaction"/><br>
        </form>

        </br>
        </br>
        <h2>Delete Transaction</h2>
        <form action ="transactions.php" method="post">
            <label>ID:</label>
            <input type="text" name="id"/><br>
            <input type="hidden" name="action" value ="delete"/>
            <label>&nbsp;</label>
            <input type="submit" value="Delete Transaction"/><br>
        </form>
    </body>
    <?php include ('footer.php'); ?>
</html>
