<?php

class Helper{
    //display errors on page when some form input fields aren't properly filled
    public static function failingFlashes($errors){
        foreach ($errors as $error){
            echo '<div class="row"><div class="col-xs-6 col-xs-offset-3">'.
                '<span class="label label-danger">'.$error.'</span>'.
                '</div></div>';
        }
    } 
    
    //display success message on page when some request is successfull
    public static function successFlash($string){
        echo '<div class="row"><div class="col-xs-6 col-xs-offset-3">'.
             '<span class="label label-success">'.$string.'</span>'.
             '</div></div>';
    }
}
