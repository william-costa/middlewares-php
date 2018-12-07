<?php

namespace App\middlewares\auth;

use App\interfaces\MiddlewareInterface;
use App\interfaces\RequestInterface;

class MiddlewareAuth implements MiddlewareInterface{

  private $user = 'usuario';

  private $pass = '1234';

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
