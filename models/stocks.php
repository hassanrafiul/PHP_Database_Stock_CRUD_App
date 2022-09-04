<?php

class Stock {
    private $symbol, $name, $current_price, $id;
    
    public function __construct($symbol, $name, $current_price, $id = 0){
        $this->set_symbol($symbol);
        $this->set_name($name);
        $this->set_current_price($current_price);
        $this->set_id ($id);
   
}
    
    public function set_symbol($symbol) {
        $this->symbol = $symbol;
    }
    public function get_symbol() {
        return $this->symbol;
    }
    public function set_name($name) {
        $this->name = $name;
    }
    public function get_name() {
        return $this->name;
    }
    public function set_current_price($current_price) {
        $this->current_price = $current_price;
    }
    public function get_current_price() {
        return $this->current_price;
    }
    public function set_id($id) {
        $this->id= $id;
    }
    public function get_id() {
        return $this->id;
    }
    
    
}

function list_stocks() {
    
    global $database;
    
    $query = 'SELECT symbol, name, current_price, id FROM stocks';
    
    $statement = $database->prepare($query);
    
    $statement->execute();

    $stocks = $statement->fetchAll();

    $statement->closeCursor();
    
    $stocks_array = array();
    
    foreach ($stocks as $stock ) {
        $stocks_array[]  = new Stock($stock['symbol'], $stock['name'],
                $stock['current_price'],$stock['id']);
        
    }
    
    return $stocks_array;
    
}

function insert_stock($stock) {
    
    global $database;

    $query = "INSERT INTO stocks (symbol, name, current_price) "
            . "VALUES (:symbol, :name, :current_price)";
    
    $statement = $database->prepare($query);
    
    $statement->bindValue(":symbol", $stock->get_symbol());
    $statement->bindValue(":name", $stock->get_name());
    $statement->bindValue(":current_price", $stock->get_current_price());

    $statement->execute();
    $statement->closeCursor();
}

function update_stock($stock) {
    
    global $database;

    $query = "update stocks set name = :name, current_price = :current_price "
            . " where symbol = :symbol";

    $statement = $database->prepare($query);
    
    $statement->bindValue(":symbol", $stock->get_symbol());
    $statement->bindValue(":name", $stock->get_name());
    $statement->bindValue(":current_price", $stock->get_current_price());

    $statement->execute();
    $statement->closeCursor();
}

function delete_stock($stock) {
    
    global $database;
    
    $query = "delete from stocks "
            . " where symbol = :symbol";

    $statement = $database->prepare($query);
    
    $statement->bindValue(":symbol", $stock->get_symbol());

    $statement->execute();

    $statement->closeCursor();
}
