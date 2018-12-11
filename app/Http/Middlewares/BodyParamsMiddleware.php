<?php

namespace App\Http\Middlewares;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 *
 * Implementação de MiddlewareInterface responsável por processar a validação de campos obrigatórios no body
 *
 * @author William Costa
 *
 */
class BodyParamsMiddleware implements MiddlewareInterface {

  /**
   * Campos obrigatórios
   * @var array
   */
  private $camposObrigatorios;

  /**
   * Define os campos obrigatórios a serem validados
   * @method __construct
   * @param  array       $camposObrigatorios
   */
  public function __construct(array $camposObrigatorios){
    $this->camposObrigatorios = $camposObrigatorios;
  }

  /**
   * Método responsável por processar a requisição
   * @method process
   * @param  ServerRequestInterface  $request
   * @param  RequestHandlerInterface $handler
   * @return ResponseInterface
   */
  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
    $body = $request->getBody();

    //VALIDAÇÃO DE CAMPOS
    foreach($this->camposObrigatorios as $key=>$value){
      $campo = $value;
      $tipo  = 'mixed';
      if(!is_numeric($key)){
        $campo = $key;
        $tipo = $value;
      }
      if(!isset($body[$campo])) throw new \Exception("O campo '".$campo."' é obrigatório", 400);
      switch ($tipo) {
        case 'numeric':
          if(!is_numeric($body[$campo])) throw new \Exception("O campo '".$campo."' deve ser numérico", 400);
        break;
        default:
          if(!strlen($body[$campo])) throw new \Exception("O campo '".$campo."' não pode estar vazio", 400);
        break;
      }
    }

    //RESPONSE
    $response = $request->getResponseBody();
    $response[] = [
                    'middleware'=>'Campos obrigatórios',
                    'sucesso'=>true
                  ];
    $request->setResponseBody($response);

    return $handler->handle($request);
  }

}
