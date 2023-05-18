<?php

namespace App\Controller;

use App\Contracts\ParserControllerInterface;
use App\Requests\ParserRequest;
use App\Services\URLInfoService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ParserController implements ParserControllerInterface
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function handle(Request $request, Response $response): Response
    {
        $data = $request->getQueryParams();
        if ((new ParserRequest($data))->validate([
            'url' => 'required'
        ]) === false) {
            $response->getBody()->write(json_encode(['status' => 'error', 'message' => 'Запрос не прошел валидацию']));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $service = new URLInfoService($data['url']);
        $service->handle();
        $result = $service->getResult();

        if (empty($result))
            $response->getBody()->write(json_encode(['status' => 'error', 'message' => 'Не получилось спарсить страницу']));
        else
            $response->getBody()->write($result);

        return $response->withHeader('Content-Type', 'application/json');
    }
}