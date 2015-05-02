<?php

require_once 'core/init.php';

$userUpdate = DB::getInstance()->update('users', 6, array('password' => 'new_password', 'name' => 'Ruby Briant'));
