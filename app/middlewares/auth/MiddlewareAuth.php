<?php
/**
 * Middleware de autenticação
 * Responsável por verificar se o usuário possui acesso ao sistema
 *
 * @author William Costa
 */

namespace App\middlewares\auth;

use App\interfaces\MiddlewareInterface;
use App\interfaces\RequestInterface;

class MiddlewareAuth implements MiddlewareInterface{

  /**
   * Nome de usuário
   * @var string
   */
  private $user = 'usuario';

  /**
   * Senha de acesso
   * @var string
   */
  private $pass = '1234';

  /**
   * Métod responsável por executar as ações do middleware
   * @method process
   * @param  RequestInterface    $request
   * @param  MiddlewareInterface $delegate
   * @return mixed
   */
  public function process(RequestInterface $request, MiddlewareInterface $delegate){
    $headers = $request->getHeaders();
    if((!isset($headers['user']) or $headers['user'] != $this->user) or !isset($headers['pass']) or $headers['pass'] != $this->pass){
      throw new \Exception('Acesso negado', 401);
    }

    $response = $request->getResponse();
    $response[] = [
                    'middleware'=>'Autenticação',
                    'sucesso'=>true
                  ];
    $request->setResponse($response);

    return $delegate->process($request,$delegate);
  }

}
