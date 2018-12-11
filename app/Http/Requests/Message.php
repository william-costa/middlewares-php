<?php

namespace App\Http\Requests;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

/**
 *
 * Implementação de MessageInterface
 *
 * @author William Costa
 *
 */
class Message implements MessageInterface {

  /**
   * Headers da requisição
   * @var array
   */
  private $headers = [];

  /**
   * Corpo da requisição
   * @var array
   */
  private $body = [];

  /**
   * Método responsável por inicializar os dados da mensagem
   * @method messageInitialize
   * @param  array             $headers
   * @param  array             $body
   */
  public function messageInitialize($headers,$body){
    $this->headers = $headers;
    $this->body = $body;
  }

  /**
   * Responsável por definir um valor no header
   * @method withHeader
   * @param  string      $name
   * @param  string      $value
   * @return this
   */
  public function withHeader($name, $value){
    $this->headers[$name] = $value;
    return $this;
  }

  /**
   * Método responsável por obter os headers da requisição
   * @method getHeaders
   * @return array
   */
  public function getHeaders(){
    return $this->headers;
  }

  /**
   * Método responsável por aplicar os headers da requisição
   * @method applyHeaders
   */
  public function applyHeaders(){
    foreach($this->headers as $key=>$value){
      header($key.': '.$value);
    }
  }

  /**
   * Método responsável por definir o corpo da requisição
   * @method setBody
   * @param  array  $body
   */
  public function setBody($body){
    $this->body = $body;
    return $this;
  }

  /**
   * Método responsável por retornar por retornar o corpo da requisição
   * @method getBody
   * @return array
   */
  public function getBody(){
    return $this->body;
  }

  /**
   * Not implemented
   */
  public function getProtocolVersion(){}

  /**
   * Not implemented
   */
  public function withProtocolVersion($version){}

  /**
   * Not implemented
   */
  public function hasHeader($name){}

  /**
   * Not implemented
   */
  public function getHeader($name){}

  /**
   * Not implemented
   */
  public function getHeaderLine($name){}

  /**
   * Not implemented
   */
  public function withAddedHeader($name, $value){}

  /**
   * Not implemented
   */
  public function withoutHeader($name){}

  /**
   * Not implemented
   */
  public function withBody(StreamInterface $body){}

}
