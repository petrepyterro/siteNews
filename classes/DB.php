<?php

class DB{
    private static $_instance = null;
    private $_pdo, $_query, $_error = false, $_results, $_count=0;
    
    private function __construct() {
        try{
            $this->_pdo = new PDO(
              'mysql:host='.Config::get('mysql/host').';dbname=' . Config::get('mysql/db'),
               Config::get('mysql/username'),
               Config::get('mysql/password')     
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    //we don't want more than an instance of DB class
    //because we want only one connection per user established
    //with database
    public static function getInstance(){
        if (!self::$_instance){
            self::$_instance = new DB();
        }
        return self::$_instance;    
    }
    
    
    public function query($sql, $params = array()) {
        $this->_error = FALSE;
        if($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            //bind the value of each $params item
            //to prepared PDO statement
            if(count($params)){
                foreach($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            
            //try to execute the prepared PDO statement
            //if some errors occur undo the changes
            //made by execution of the statement
            $this->_pdo->beginTransaction();
            try{
                
                $this->_query->execute();
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
                $this->_pdo->commit();
            } catch (PDOException $e){
                $this->_pdo->rollBack();
                $this->_error = TRUE;
            }
            
        }
        return $this;
    }
    
    //create one generic function no matter which query type we'll execute
    //e.g DELETE, SELECT 
    public function action($action, $table, $where = array()){
        if(count($where) === 3){
            $operators = array('=', '>', '<', '>=', '<=');
            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];
            
            //create the SQL string to feed in the prepared statement
            //that it'll be executed in the custom query function
            //created above
            if(in_array($operator, $operators)){
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if (!$this->query($sql, array($value))->error()){
                    return $this;
                }
            }
        }
        return FALSE;
    }
    
    //create a custom function for SELECT queries
    public function get($table, $where){
        return $this->action("SELECT *", $table, $where);
    }
    
    //create a custom function for DELETE queries
    public function delete($table, $where){
        return $this->action("DELETE", $table, $where);
    }
    
    //create a custom function for INSERT query
    public function insert($table, $fields = array()){
        if(count($fields)){
            $keys = array_keys($fields);
            $values = '';
            $x = 1;
            
            foreach($fields as $field){
                $values .= '? ';
                if ($x<count($fields)){
                    $values .= ', ';
                }
                $x++;
            }
            
            //create the SQL string to feed in the prepared statement
            //that it'll be executed in the custom query function of this class
            $sql = "INSERT INTO users (`" . implode('`, `', $keys) . "`) VALUES ($values)";
            if (!$this->query($sql, $fields)->error()){
                return TRUE;
            }
        }
        return FALSE;
    }
    
    //create a custom function for UPDATE query
    public function update($table, $id, $fields){
        $set = '';
        $x = 1;
        
        foreach ($fields as $name => $value){
            $set .= "{$name} = ?";
            if ($x<count($fields)){
                $set .= ', ';
            }
            $x++;
        }
        
        //create the SQL string to feed in the prepared statement
        //that it'll be executed in the custom query function
        $sql = "UPDATE {$table} SET {$set} WHERE id={$id}";
        if(!$this->query($sql, $fields)->error()){
            return TRUE;
        }
        
        return FALSE;
    }
    
    public function error(){
        return $this->_error;
    }
    
    //count the number of results returned
    //by queries execution
    public function count(){
        return $this->_count;
    }
    
    //return first result of query execution
    public function first(){
        return $this->_results[0];
    }
    
    public function results(){
        return $this->_results;
    }
}
