<?php

namespace App\Http\Requests;

use App\Http\Responses\Response;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Implementação de RequestHandlerInterface utilizado para requisições de Sucesso
 *
 * @author William Costa
 */
class SuccessRequestHandler implements RequestHandlerInterface {

    /**
     * Método responsável por retornar uma Response de sucesso
     * @method handle
     * @param  ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface {
      return (new Response())->setBody($request->getResponseBody());
    }
}
