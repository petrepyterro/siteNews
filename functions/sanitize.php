<?php

function escape($string){
    //all characters which have HTML character entity equivalents 
    //are translated into these entities including both
    //simple and double quotes
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}
