<?php

namespace App\Http\Middlewares;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 *
 * Implementação de MiddlewareInterface responsável por processar a autenticação do usuário na requisição
 *
 * @author William Costa
 *
 */
class AuthorizationMiddleware implements MiddlewareInterface {

  /**
   * Usuário da requisição
   * @var string
   */
  private $user = 'usuario';

  /**
   * Senha da requisição
   * @var string
   */
  private $pass = '1234';

  /**
   * Método responsável por processar a requisição
   * @method process
   * @param  ServerRequestInterface  $request
   * @param  RequestHandlerInterface $handler
   * @return ResponseInterface
   */
  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
    $headers = $request->getHeaders();

    //AUTENTICAÇÃO
    if((!isset($headers['user']) or $headers['user'] != $this->user) or !isset($headers['pass']) or $headers['pass'] != $this->pass){
      throw new \Exception('Acesso negado', 401);
    }

    //RESPONSE
    $response = $request->getResponseBody();
    $response[] = [
                    'middleware'=>'Autenticação',
                    'sucesso'=>true
                  ];
    $request->setResponseBody($response);

    return $handler->handle($request);
  }

}
