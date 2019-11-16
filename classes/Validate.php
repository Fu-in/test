<?php
class Validate
{
    private $_passed = false, $_errors = [], $_db = null;
    public function check($source, $items = [])
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = $source[$item];
                if ($rule === 'required' && empty($value)) {
                    $this->addError("$item is required");
                }
            }
        }
        if (empty($this->errors())) {
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