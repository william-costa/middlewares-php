<?php
/**
 * Middleware de response em JSON
 * Responsável por formatar e retornar os dados em JSON
 *
 * @author William Costa
 */

namespace App\middlewares\response;

use App\interfaces\MiddlewareInterface;
use App\interfaces\RequestInterface;

class MiddlewareJsonResponse implements MiddlewareInterface{

  /**
   * Métod responsável por executar as ações do middleware
   * @method process
   * @param  RequestInterface    $request
   * @param  MiddlewareInterface $delegate
   * @return mixed
   */
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
