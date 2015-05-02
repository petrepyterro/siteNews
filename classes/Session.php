<?php

class Session{
    //check if some session with some name exist
    public static function exists($name){
        return isset($_SESSION[$name]) ? TRUE : FALSE;
    }
       
    
    //write a value in a session
    public static function put($name, $value){
        return $_SESSION[$name] = $value;
    }
    
    //delete a session
    public static function delete($name){
        if (self::exists($name)){
            unset($_SESSION[$name]);
        }
    }
    
    //get the session value
    public static function get($name){
        return $_SESSION[$name];
    }
    
    //let the user know what happens with his requests
    //they are failing, they are successfull?
    public static function flash($name, $string=""){
        if (self::exists($name)){
            $session = self::get($name);
            //this session must disapear until next request
            self::delete($name);
            return $session;
        } else {
            self::put($name, $string);
        }
    }
}
