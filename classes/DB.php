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
}
