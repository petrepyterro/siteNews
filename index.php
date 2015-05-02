<?php require_once 'core/init.php';?>
<!DOCTYPE html>
<html lang="en">
    <?php include_once 'includes/header.php';?>
    <?php 
        DB::getInstance()->insert('users', array(
            'username'  => 'alex',
            'name'      => 'aba',
            'password'  => 'avalon'
        ));
    ?>
    <body>        
        <div class="container">
            <?php if(Session::exists('success')) Helper::successFlash(Session::flash('success'))?>                    
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <a href="register.php">Register</a>
                </div>
            </div>           
        </div>            
        <?php include_once 'includes/footer.php';?>
    </body>
</html>

