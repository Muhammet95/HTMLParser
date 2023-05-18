<?php

namespace App\Contracts;

interface ParserRequestInterface
{
    /**
     * @param array $data
     */
    public function __construct(array $data);

    /**
     * @param array $rules
     * @return bool
     */
    public function validate(array $rules): bool;
}