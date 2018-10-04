<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB
 *
 * @author Ewerton
 */
class DB {
    private static $_instance = null;
    private $_pdo, $_query, $_error = false, $_results, $_count = 0, $_lastInsertID = '';
    
    private function __construct() {
        try{
            //$this->_pdo = new PDO('database:host;dname=','user','password');
            //$conn = new PDO("pgsql:host=$this->host port=$this->port dbname=$this->dbname", "$this->username", "$this->password");
            //echo "PDO connection object created";
            $this->_pdo = new PDO('mysql:host=127.0.0.1;dbname=database','root','');
            //$this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
  
    public static function get_instance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }
    
    public function query($sql,$params = []){
        $this->_error = false;
        
        if($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            if(count($params)){
                foreach($params as $value){ 
                    $this->_query->bindValue($x, $value);
                    $x++;
                }
            }
            
            if($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
                $this->_lastInsertID = $this->_pdo->lastInsertId();
            } else{
                $this->_error = true;
            }  
            
        }
        return $this;
    }
    
    public function insert($table, $fields = []){
        $fieldString = '';
        $valueString = '';
        $values = [];
        foreach($fields as $field => $value){
            $fieldString .= '`'.$field.'`,';
            $valueString .= '?,';
            $values[] = $value;
        }
        $valueString = rtrim($valueString,',');
        $fieldString = rtrim($fieldString,',');        
        $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";
        
        if($this->query($sql,$values)){
            return true;
        } else{
            return false;
        }
    }
    
    public function update($table,$id,$fields = []){
        $fieldString = '';
        $values = [];
        foreach($fields as $field => $value){
            $fieldString .= ' '.$field.' = ?,';
            $values[] = $value;
        }
        $fieldString = trim($fieldString);
        $fieldString = rtrim($fieldString,',');
        
        $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";
        
        if($this->query($sql,$values)){
            return true;
        } else {
            return false;
        }
        
    }
    
    
    // getters
    public function get_error() {
        return $this->_error;
    }

    public function get_results() {
        return $this->_results;
    }

    public function get_count() {
        return $this->_count;
    }

    public function get_lastInsertID() {
        return $this->_lastInsertID;
    }

 
}
