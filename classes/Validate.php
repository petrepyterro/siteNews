<?php

class Validate{
    private $_passed = false,
            $_errors = array(),
            $_db = null;
    
    public function __construct() {
        $this->_db = DB::getInstance();
    }
    
    /*
     * Check if $_POST or $_GET array comply with some rules
     * Rules will be exposed as an array like so
     * 'username' => array(
     *      'required'      => true,
     *      'min'           => 2,
     *      'max'           => 20
     *      'unique'        => 'users'
     */
    public function check($source, $items = array()){
        foreach($items as $item => $rules){
            foreach ($rules as $rule => $rule_value){
                
                //sanitize user input
                $value = trim(escape($source[$item]));
                
                //if some input value is empty and required rule is enforced
                //add an error validation
                if($rule === 'required' && empty($value)){
                    $this->addError("{$item} is required");
                //we must have some non empty input value to apply the other rules
                } elseif(!empty($value)){
                    switch($rule){
                        case 'min':
                            if (strlen($value) < $rule_value){
                                $this->addError("Length of {$item} field must be at least {$rule_value} characters");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value){
                                $this->addError("Length of {$item} field must be at most {$rule_value} characters");
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]){
                                $this->addError("{$rule_value} must match {$item}");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if ($check->count()){
                                $this->addError("{$value} is already taken");
                            }
                            break;
                    }
                }
                
            }
        }
        if (empty($this->errors())){
            $this->_passed=TRUE;
        }
        
        return $this;
    }
    
    private function addError($error){
        $this->_errors[] = $error;
    }

    public function errors(){
        return $this->_errors;
    }
    
    public function passed(){
        return $this->_passed;
    }
}