<?php

class Config{
    //access initialization options in an easier manner
    //instead of $GLOBALS['config']['mysql']['host'] we'll use Config::get('mysql/host')
    public static function get($path = null){
        if($path){
            $config = $GLOBALS['config'];
            $path = explode('/', $path);
            
            foreach ($path as $subpath){
                if (isset($config[$subpath])){
                    $config = $config[$subpath];
                }
            }
            return $config;
        }
        return FALSE;
    }
}