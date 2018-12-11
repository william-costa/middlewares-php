<?php

namespace App\Http\Requests;

use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 *
 * Implementação da fábrica ServerRequestFactoryInterface
 *
 * @author William Costa
 *
 */

class ServerRequestFactory implements ServerRequestFactoryInterface {

  /**
   * Método responsável por criar uma ServerRequest com base nas variáveis globais ($_SERVER,$_GET,$_POST)
   * @method createServerRequestFromGlobals
   * @return ServerRequestInterface
   */
  public static function createServerRequestFromGlobals() : ServerRequestInterface {
    $INPUT = file_get_contents("php://input");
    $parsedBody = !empty($INPUT) ? json_decode($INPUT,true) : $_POST;
    return new ServerRequest(getallheaders(),$parsedBody,$_GET,$_SERVER);
  }

  /**
   * Not implementer
   */
  public function createServerRequest(string $method, $uri, array $serverParams = []) : ServerRequestInterface{}

}
