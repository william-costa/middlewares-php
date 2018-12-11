<?php

namespace App\Http\Requests;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

/**
 *
 * Implementação de RequestInterface
 *
 * @author William Costa
 *
 */
class Request extends Message implements RequestInterface {

  /**
   * Método responsável por inicializar os valores da request
   * @method requestInitialize
   * @param  array            $headers
   * @param  array            $body
   */
  public function requestInitialize($headers,$body){
    $this->messageInitialize($headers,$body);
  }

  /**
   * Not implemented
   */
  public function getRequestTarget(){}

  /**
   * Not implemented
   */
  public function withRequestTarget($requestTarget){}

  /**
   * Not implemented
   */
  public function getMethod(){}

  /**
   * Not implemented
   */
  public function withMethod($method){}

  /**
   * Not implemented
   */
  public function getUri(){}

  /**
   * Not implemented
   */
  public function withUri(UriInterface $uri, $preserveHost = false){}

}
