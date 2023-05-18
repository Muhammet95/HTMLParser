<?php

namespace App\Services;

abstract class BaseService
{
    /**
     * @var string
     */
    private string $url;
    /**
     * @var string
     */
    private string $result;

    /**
     * @param string $url
     * Create service
     */
    abstract public function __construct(string $url);

    /**
     * Handle data
     * @return void
     */
    abstract public function handle(): void;

    /**
     * @return string
     * Return result
     */
    abstract public function getResult(): string;
}