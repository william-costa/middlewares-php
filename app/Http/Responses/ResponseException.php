<?php

namespace App\Http\Responses;

use Psr\Http\Message\ResponseInterface;

/**
 * Extensão de Response para o tratamento de exceptions
 *
 * @author William Costa
 */
class ResponseException extends Response{

  /**
   * Define os dados da mensagem
   * @method __construct
   * @param  Exception   $e
   */
  public function __construct(\Exception $e){
    $this->withStatus($e->getCode());
    $this->setBody([
      'error'=>$e->getMessage()
    ]);
  }

}

