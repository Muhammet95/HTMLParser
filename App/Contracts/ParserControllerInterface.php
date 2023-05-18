<?php

namespace App\Contracts;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

interface ParserControllerInterface
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function handle(Request $request, Response $response): Response;
}