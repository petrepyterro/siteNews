<?php
session_start();

//define global variables that we'll use throughout entire application
$GLOBALS['config'] = array(
    //required parameters to establish mysql connection
    'mysql'         => array(
        'host'          => '127.0.0.1',
        'username'      => 'root',
        'password'      => 'mysql',
        'db'            => 'news'
    ),
    //session for remember me functionaity
    'remember'      => array(
        'cookie_name'   => 'hash',
        'cookie_expiry' => '604800' 
    ),
    
    'session'       => array(
        'session_name'  => 'user',
        'token_name'    => 'token'
    )
);

//create a queue of autoload functions, and runs through each of them in order
//they are defined
spl_autoload_register(function($class){
    require_once 'classes/' . $class . '.php';
});

require_once 'functions/sanitize.php';


