<?php

namespace App\Requests;

class BaseRequest
{
    /**
     * @var array|string[]
     */
    private array $existed_functions = ['required'];
    /**
     * @var array
     */
    protected array $data = [];
    /**
     * @param array $rules
     * @return bool
     */
    public function validate(array $rules): bool
    {
        foreach ($rules as $key => $rule) {
            if (in_array($rule, $this->existed_functions) && $this->$rule($key) === false)
                return false;
        }
        return true;
    }

    /**
     * @param string $key
     * @return bool
     */
    private function required(string $key): bool
    {
        if (empty($this->data[$key]))
            return false;
        else
            return true;
    }
}