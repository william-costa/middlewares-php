<?php

namespace App\middlewares\request;

use App\interfaces\MiddlewareInterface;
use App\interfaces\RequestInterface;

class MiddlewareRequestPostValidation implements MiddlewareInterface{

  public function process(RequestInterface $request, MiddlewareInterface $delegate){
    if(!isset($_SERVER['REQUEST_METHOD']) or $_SERVER['REQUEST_METHOD'] != 'POST'){
      throw new \Exception('Somente requisições POST são permitidas', 405);
    }

    $response = $request->getResponse();
    $response[] = [
                    'middleware'=>'Requisição POST',
                    'sucesso'=>true
                  ];
    $request->setResponse($response);

    return $delegate->process($request,$delegate);
  }

}
