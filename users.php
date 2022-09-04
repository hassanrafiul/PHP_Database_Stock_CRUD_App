<?php

try{
    
    require_once 'models/database.php';
    require_once 'models/users.php ';


    $action = htmlspecialchars(filter_input(INPUT_POST, "action"));    
    $name = htmlspecialchars(filter_input(INPUT_POST, "name"));
    $email_address = htmlspecialchars(filter_input(INPUT_POST, "email_address"));
    $cash_balance = filter_input(INPUT_POST, "cash_balance", FILTER_VALIDATE_FLOAT);

    $error_messsage = "";
    
    if ($action == "insert_or_update" && $name != "" && $email_address != "" && $cash_balance != 0) {
        
        $insert_or_update = filter_input(INPUT_POST, 'insert_or_update');
        
        $user = new User($name, $email_address, $cash_balance);
        
        if ( $insert_or_update == "insert") {
            
            insert_user($user);
            
        } else if ( $insert_or_update == "update" ) {
            
            update_user($user);
            
        }
        
    } else if ($action == "delete" && $email_address != "") {
        
        $user = new User("", $email_address, 0);

        delete_user($user) ;
        
        header ("Location: users.php");       
        
    } else if ($action != "") {
        
        echo $error_messsage = "Missing name, email address and cash balance.";
//        include('views/error.php');
       
    }

    $users = list_users();
    
    include ('views/users.php');

    
} catch (Exception $e) {
    $error_message = $e->getMessage();
    include('views/error.php');
}
