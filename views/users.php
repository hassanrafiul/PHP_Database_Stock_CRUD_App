<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Users List</title>
    </head>
    <?php include ('topnavigation.php'); ?>
    <body>
        <table>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>Cash Balance</th>
                <th>ID</th></tr>           
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user->get_name(); ?></td>
                    <td><?php echo $user->get_email_address(); ?></td>
                    <td><?php echo $user->get_cash_balance(); ?></td>
                    <td><?php echo $user->get_id(); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        
        <h2>Add Users or Update Users</h2>
        <form action ="users.php" method="post">
            <label>Name:</label>
            <input type="text" name="name"/><br>
            <label>Email Address:</label>
            <input type="text" name="email_address"/><br>
            <label>Cash Balance:</label>
            <input type="text" name="cash_balance"/><br> 
            <input type ="hidden" name ="action" value ="insert_or_update"/>
            <input type="radio" name="insert_or_update" value ="insert" checked>Add</br>
            <input type="radio" name="insert_or_update" value ="update">Update</br>
            <label>&nbsp;</label>
            <input type="submit" value="Submit"/><br>
        </form>
     
        <h2>Delete User</h2>
        <form action ="users.php" method="post">
            <label>Email Address:</label>
            <input type="text" name="email_address"/><br>
            <input type ="hidden" name ="action" value ="delete"/>
            <label>&nbsp;</label>
            <input type="submit" value="Delete User"/><br>
        </form>
    </body>
    <?php include ('footer.php'); ?>
</html>