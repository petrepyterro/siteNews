<?php

require_once 'core/init.php';

$userInsert = DB::getInstance()->insert('users', array('username' => 'sanda', 'salt' => 'salt', 'password' => 'password'));
