<?php

class Session{
    public static function exists($name){
        return isset($_SESSION[$name]) ? TRUE : FALSE;
    }
    
    public static function put($name, $value){
        $_SESSION[$name] = $value;
        return $_SESSION[$name];
    }
    
    
    public static function delete($name){
        if (self::exists($name)){
            unset($_SESSION[$name]);
        }
    }
    
    public static function get($name){
        return $_SESSION[$name];
    }
}
