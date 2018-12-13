<?php

namespace App\Http\Responses;

use App\Http\Requests\Message;
use Psr\Http\Message\ResponseInterface;

/**
 * Implementação de ResponseInterface
 *
 * @author William Costa
 */
class Response extends Message implements ResponseInterface{

  /**
   * Código de status
   * @var int
   */
  private $statusCode = 200;

 /**
  * Frase do status
  * @var string
  */
  private $reasonPhrase = '';

  /**
   * Formato de saída
   * @var string
   */
  private $type = 'json';

  /**
   * Método responsável por obter a resposta
   * @method getResponse
   * @return string
   */
  public function getResponse(){
    http_response_code($this->getStatusCode());
    switch ($this->type) {
      case 'json':
        $this->withHeader('Content-Type','application/json')->applyHeaders();
        return json_encode($this->getBody(),JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      break;
    }
  }

  /**
   * Método mágico de resposta
   * @method __toString
   * @return string
   */
  public function __toString(){
    return $this->getResponse();
  }

  /**
   * Método reponsável por obter o código de status da requisição
   * @method getStatusCode
   * @return int
   */
  public function getStatusCode(){
    return $this->statusCode;
  }

  /**
   * Método responsável por definir o código de status
   */
  public function withStatus($code, $reasonPhrase = ''){
    $this->statusCode   = $code;
    $this->reasonPhrase = $reasonPhrase;
  }

  /**
   * Not implemented
   */
  public function getReasonPhrase(){}
}

