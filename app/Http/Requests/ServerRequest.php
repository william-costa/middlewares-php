<?php

namespace App\Http\Requests;

use Psr\Http\Message\ServerRequestInterface;

/**
 *
 * Implementação de ServerRequestInterface
 *
 * @author William Costa
 *
 */
class ServerRequest extends Request implements ServerRequestInterface {

  /**
   * Corpo da requisição processado
   * @var array
   */
  private $parsedBody;

  /**
   * Parâmetros $_GET
   * @var array
   */
  private $queryParams = [];

  /**
   * Corpo da resposta -> injeção de dados entre os middlewares
   * @var array
   */
  private $responseBody = [];

  /**
   * Parâmetros $_SERVER
   * @var array
   */
  private $serverParams = [];

  /**
   * Responsáel por definir os valores da requisição
   * @method __construct
   * @param  array       $headers
   * @param  array       $body
   * @param  array       $queryParams
   * @param  array       $serverParams
   */
  public function __construct($headers = [],$body = [], $queryParams = [], $serverParams = []) {
    $this->requestInitialize($headers,$body);
    $this->parsedBody   = $this->getBody();
    $this->queryParams  = $queryParams;
    $this->serverParams = $serverParams;
  }

  /**
   * Método responsável por retornar o corpo da resposta
   * @method getResponseBody
   * @return array
   */
  public function getResponseBody(){
    return $this->responseBody;
  }

  /**
   * Método repsonsável por definir o corpo da resposta
   * @method setResponseBody
   * @param  array           $responseBody
   */
  public function setResponseBody($responseBody){
    $this->responseBody = $responseBody;
  }

  /**
   * Método responsável por obter os parâmetros SERVER
   * @method getServerParams
   * @return array
   */
  public function getServerParams(){
    return $this->serverParams;
  }

  /**
   * Not implemented
   */
  public function getCookieParams(){}

  /**
   * Not implemented
   */
  public function withCookieParams(array $cookies){}

  /**
   * Not implemented
   */
  public function getQueryParams(){}

  public function withQueryParams(array $query){}

  /**
   * Not implemented
   */
  public function getUploadedFiles(){}

  /**
   * Not implemented
   */
  public function withUploadedFiles(array $uploadedFiles){}

  /**
   * Not implemented
   */
  public function getParsedBody(){}

  /**
   * Not implemented
   */
  public function withParsedBody($data){}

  /**
   * Not implemented
   */
  public function getAttributes(){}

  /**
   * Not implemented
   */
  public function getAttribute($name, $default = null){}

  /**
   * Not implemented
   */
  public function withAttribute($name, $value){}

  /**
   * Not implemented
   */
  public function withoutAttribute($name){}
}
