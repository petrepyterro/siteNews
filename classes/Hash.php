<?php

class Hash{
    
    //passwords are not saved in plain text in databases
    public static function make($string, $salt = ''){
        return hash('sha256', $string, $salt);
    }
    
    public static function salt($length){
        //Creates an initialization vector (IV) from a random source.
        //The IV is only meant to give an alternative seed to the encryption routines. 
        //This IV does not need to be secret at all, though it can be desirable. 
        //You even can send it along with your ciphertext without losing security.
        return mcrypt_create_iv($length);
    }
    
    public static function unique(){
        return self::make(uniqid());
    }
}

