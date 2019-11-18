<?php
class Validate
{
    private $_passed = false, $_db = null, $_errors = [];

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = [])
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = trim($source[$item]);
                if ($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is require");
                } else {
                    if (!empty($value)) {
                        switch ($rule) {
                            case 'min':
                                if (strlen($value) < $rule_value) {
                                    $this->addError("$item must be minimum a $rule_value characters");
                                }
                                break;
                            case 'max':
                                if (strlen($value) > $rule_value) {
                                    $this->addError("$item must be maximum a $rule_value characters");
                                }
                                break;
                            case 'unique_username':
                                $check = $this->_db->get($rule_value, [$item, '=', $value]);
                                if ($check->count()) {
                                    $this->addError("The $value username allready exists. Please choose another");
                                }
                                break;
                            case 'valid_email':
                                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                    $this->addError("The $value email address is invalid");
                                }
                                break;
                            case 'unique_email':
                                $check = $this->_db->get($rule_value, [$item, '=', $value]);
                                if ($check->count()) {
                                    $this->addError("The $value email allready exists");
                                }
                                break;
                            case 'matches':
                                if ($value != $source[$rule_value]) {
                                    $this->addError("The passwords do not match");
                                }
                                break;
                        }
                    }
                }
            }
        }
        if (empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this;
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }

}