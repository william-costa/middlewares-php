<?php
/**
 * Middleware de validação do corpo da requisição
 * Responsável por validar os campos obrigatórios e formato dos dados enviados no corpo da requisição
 *
 * @author William Costa
 */

namespace App\middlewares\request;

use App\interfaces\MiddlewareInterface;
use App\interfaces\RequestInterface;

class MiddlewareRequestBodyValidation implements MiddlewareInterface{

  /**
   * Métod responsável por executar as ações do middleware
   * @method process
   * @param  RequestInterface    $request
   * @param  MiddlewareInterface $delegate
   * @return mixed
   */
  public function process(RequestInterface $request, MiddlewareInterface $delegate){
    $body = $request->getBody();
    $camposObrigatorios = [
                            'nome'=>'string',
                            'valor'=>'numerico'
                          ];
    foreach($camposObrigatorios as $campo=>$tipo){
      if(!isset($body[$campo])) throw new \Exception("O campo '".$campo."' é obrigatório", 400);
      switch ($tipo) {
        case 'numerico':
          if(!is_numeric($body[$campo])) throw new \Exception("O campo '".$campo."' deve ser numérico", 400);
        break;
        default:
          if(!strlen($body[$campo])) throw new \Exception("O campo '".$campo."' não pode estar vazio", 400);
        break;
      }
    }

    $response = $request->getResponse();
    $response[] = [
                    'middleware'=>'Campos obrigatórios',
                    'sucesso'=>true
                  ];
    $request->setResponse($response);

    return $delegate->process($request,$delegate);
  }


}
