<?php

namespace App\middlewares\response;

use App\interfaces\MiddlewareInterface;
use App\interfaces\RequestInterface;

class MiddlewareJsonResponse implements MiddlewareInterface{

  public function process(RequestInterface $request, MiddlewareInterface $delegate){
    $response = $request->getResponse();
    $response[] = [
                    'middleware'=>'JSON Response',
                    'sucesso'=>true
                  ];
    $request->setResponse($response);
    
    return json_encode($request->getResponse(),JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  }

}
