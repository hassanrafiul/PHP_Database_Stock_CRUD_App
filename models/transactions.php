<?php

class Transaction {
    private $user_id, $stock_id, $quantity, $price, $timestamp, $id;
    
    public function __construct($user_id, $stock_id, $quantity, $price, $timestamp, $id = 0) {
        $this->set_user_id($user_id);
        $this->set_stock_id($stock_id);
        $this->set_quantity($quantity);
        $this->set_price($price);
        $this->set_timestamp($timestamp);
        $this->set_id($id);
    }
    
    public function set_user_id($user_id) {
        $this->user_id = $user_id;
    }
    
    public function get_user_id() {
        return $this->user_id;
    }
    
    public function set_stock_id($stock_id) {
        $this->stock_id = $stock_id;
    }
    
    public function get_stock_id() {
        return $this->stock_id;
    }
    
    public function set_quantity($quantity) {
        $this->quantity = $quantity;
    }
    
    public function get_quantity() {
        return $this->quantity;
    }
    
    public function set_price($price) {
        $this->price= $price;
    }
    
    public function get_price() {
        return $this->price;
    }
    
    public function set_timestamp($timestamp) {
        $this->timestamp= $timestamp;
    }
    
    public function get_timestamp() {
        return $this->timestamp;
    }
    
    public function set_id($id) {
        $this->id = $id;
    }
    
    public function get_id() {
        return $this->id;
    } 
    
}

function list_transactions() {
    
    global $database;
    
    $query = 'SELECT user_id, stock_id, quantity, price, timestamp, id FROM transaction';
    
    $statement = $database->prepare($query);
    
    $statement->execute();

    $transactions = $statement->fetchAll();

    $statement->closeCursor();
    
    $transaction_array = array();
    
    foreach ($transactions as $transaction ) {
        
        $transaction_array[] = new Transaction($transaction['user_id'], $transaction['stock_id'], 
                $transaction['quantity'], $transaction['price'], $transaction['timestamp'], 
                $transaction['id'] );
        
    }
    
    
    
    
    
    return $transaction_array;
}

function insert_transaction($transaction) {
    
    global $database;

    $query = "INSERT INTO transaction (user_id, stock_id, quantity, price) VALUES (:user_id, :stock_id, :quantity, :price )";  
    
    $statement = $database->prepare($query);
    $statement->bindValue(":user_id", $transaction->get_user_id());
    $statement->bindValue(":stock_id", $transaction->get_stock_id());
    $statement->bindValue(":quantity", $transaction->get_quantity());
    $statement->bindValue(":price", $transaction->get_price());
    

    $statement->execute();
    
    $statement->closeCursor();
}

function update_transaction($transaction) {
    
    global $database;

    $query = "update transaction set user_id = :user_id,"
            . " stock_id = :stock_id, "
            . " quantity = :quantity, "
            . " price = :price "
            . " where id = :id";

    $statement = $database->prepare($query);
    
    $statement->bindValue(":user_id", $transaction->get_user_id());
    $statement->bindValue(":stock_id", $transaction->get_stock_id());
    $statement->bindValue(":quantity", $transaction->get_quantity());
    $statement->bindValue(":price", $transaction->get_price());
    $statement->bindValue(":id", $transaction->get_id());

    $statement->execute();
    
    $statement->closeCursor();
}

function delete_transaction($transaction) {
    
    global $database;
    
    $query = "delete from transaction "
            . " where id = :id";

    $statement = $database->prepare($query);
    $statement->bindValue(":id", $transaction->get_id());

    $statement->execute();

    $statement->closeCursor();
}
