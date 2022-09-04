
<?php

// solution for CRUD in Transaction Control statement is taken from the solution video of the class



try {

    require_once 'models/database.php';
    require_once 'models/transactions.php';
    require_once 'models/stocks.php';
    require_once 'models/users.php';

    $action = htmlspecialchars(filter_input(INPUT_POST, "action"));
    $id = htmlspecialchars(filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT));
    $user_id = htmlspecialchars(filter_input(INPUT_POST, "user_id", FILTER_VALIDATE_INT));
    $stock_id = htmlspecialchars(filter_input(INPUT_POST, "stock_id", FILTER_VALIDATE_INT));
    $quantity = htmlspecialchars(filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_FLOAT));
    $price = htmlspecialchars(filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT));

    
    if ($action == "insert" && $user_id != 0 && $stock_id != 0 && $quantity != 0) {

        $users = list_users();
        $user_name = "";
        $user_email_address = "";
        $user_cash_balance = 0;

        foreach ($users as $user) {
            if ($user->get_id() == $user_id) {
                $user_name = $user->get_name();
                $user_email_address = $user->get_email_address();
                $user_cash_balance = $user->get_cash_balance();
            }
        }

        $stocks = list_stocks();
        $stock_price = 0;
        foreach ($stocks as $stock) {
            if ($stock->get_id() == $stock_id) {

                $stock_price = $stock->get_current_price();
            }
        }

        $total_cost = $stock_price * $quantity;

        if ($user_cash_balance >= $total_cost) {

            $transaction = new Transaction($_SESSION['user_id'], $stock_id, $quantity, $total_cost, "", 0);

            insert_transaction($transaction);

            $new_balance = $user_cash_balance - $total_cost;

            $user = new User($user_name, $user_email_address, $new_balance);

            update_user($user);
            
        } else {
            echo "Insufficient Fund to purchase the stock.";
        }
    } else if ($action == "update" && $user_id != 0 && $stock_id != 0 && $quantity != 0 && $price != 0 && $id != 0) {


        $transaction = new Transaction($user_id, $stock_id, $quantity, $price, $id);

        update_transaction($transaction);
        
    } else if ($action == "delete" && $id != 0) {

        echo "kamaikazi";
        $transactions = list_transactions();

        $stock_id = 0;
        $quantity = 0;
        foreach ($transactions as $transaction) {
            if ($transaction->get_id() == $id) {
                $quantity = $transaction->get_quantity();
                $stock_id = $transaction->get_stock_id();
                $user_id = $transaction->get_user_id();
            }
        }

        echo "$quantity, $stock_id, $user_id";

        $users = list_users();
        $user_name = "";
        $user_email_address = "";
        $user_cash_balance = 0;

        foreach ($users as $user) {
            if ($user->get_id() == $user_id) {
                $user_name = $user->get_name();
                $user_email_address = $user->get_email_address();
                $user_cash_balance = $user->get_cash_balance();
            }
        }

        $stocks = list_stocks();
        $stock_price = 0;
        foreach ($stocks as $stock) {
            if ($stock->get_id() == $stock_id) {

                $stock_price = $stock->get_current_price();
            }
        }

        $total_sale = $stock_price * $quantity;

        $new_balance = $user_cash_balance + $total_sale;

        $user = new User($user_name, $user_email_address, $new_balance);

        update_user($user);

        $transaction = new Transaction(0, 0, 0, 0, 0, $id);

        delete_transaction($transaction);

        header("Location: transactions.php");
        
    } else if ($action != "") {

        echo "Missing Stock_id, User_id, Quantity.";
        //include('views/error.php');
    }

    $transactions = list_transactions();

    include ('views/transactions.php');
} catch (Exception $e) {
    $error_message = $e->getMessage();
    include('views/error.php');
}




