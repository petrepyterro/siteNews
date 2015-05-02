<?php

require_once 'core/init.php';

if(Input::exists()){
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'username'  => array(
            'required'      => true,
            'min'           => 2,
            'max'           => 10,
            'unique'        => 'users'
        ),
        'password'  => array(
            'required'      => true,
            'min'           => 6,
        ),
        'password_again'=> array(
            'required'      => true,
            'matches'       => 'password'
        ),
        'name'      => array(
            'required'      => TRUE,
            'min'           => 2,
            'max'           => 40
        )
    ));
    
    if($validation->passed()){
        echo 'Passed';
    } else {
        print_r($validation->errors());
    }
}
?>
<html lang="en">
    <?php include_once 'includes/header.php';?>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <form action="" class="form" method="POST">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" autocomplete="off" value="<?php echo escape(Input::get('name'))?>"/>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" autocomplete="off" value="<?php echo escape(Input::get('username'))?>"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Choose a password</label>
                            <input type="password" class="form-control" name="password" />
                        </div>
                        <div class="form-group">
                            <label for="password_again">Enter password again</label>
                            <input type="password" class="form-control" name="password_again" />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once 'includes/footer.php';?>
    </body>
</html>
