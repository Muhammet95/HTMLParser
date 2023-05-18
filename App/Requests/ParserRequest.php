<?php

namespace App\Requests;

use App\Contracts\ParserRequestInterface;

class ParserRequest extends BaseRequest implements ParserRequestInterface
{
    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}