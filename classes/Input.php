<?php

class Input{
    //check if some user input has already some value
    //other than empty string or string filled with spaces
    public static function exists($type = 'post'){
        switch ($type){
            case 'post':
                return (!empty($_POST)) ? TRUE : FALSE;
                break;
            case 'get':
                return (empty($_GET)) ? TRUE : FALSE;
                break;
        }
    }
    
    //get the value of some user input
    public static function get($item){
        if (isset($_POST[$item])){
            return $_POST[$item];
        } elseif(isset ($_GET[$item])){
            return $_GET[$item];
        }
    }
}