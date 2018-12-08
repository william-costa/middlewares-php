<?php
/**
 * Implementação de uma Request HTTP
 * Responsável por gerenciar requisições HTTP
 *
 * @author William Costa
 */
namespace App\request;

use App\interfaces\RequestInterface;

class HttpRequest implements RequestInterface{

  /**
   * Corpo da requisição
   * @var array
   */
  private $body = [];

  /**
   * Query Params
   * @var array
   */
  private $queryParams = [];

  /**
   * Headers
   * @var array
   */
  private $headers = [];

  /**
   * Response gerado
   * @var array
   */
  private $response = [];

  /**
   * Método responsável por definir a requisição atual
   * @method __construct
   */
  public function __construct(){
    $this->processInputPost();
    $this->queryParams = $_GET;
    $this->body        = $_POST;
    $this->headers     = getallheaders();
  }

  /**
   * Método responsável processar o input post (JSON RAW)
   * @method processInputPost
   */
  public function processInputPost(){
    $INPUT = file_get_contents("php://input");
    if(!empty($INPUT)) $_POST = json_decode($INPUT,true);
  }

  /**
   * Método responsável por retornar o body da requisição
   * @method getBody
   * @return array
   */
  public function getBody(){
    return $this->body;
  }

  /**
   * Método responsável por obter os dados enviados por query params
   * @method getQueryParams
   * @return array
   */
  public function getQueryParams(){
    return $this->queryParams;
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
   * Método responsável por obter o response gerado para a requisição
   * @method getResponse
   * @return array
   */
  public function getResponse(){
    return $this->response;
  }

  /**
   * Método responsável por definir os dados da response da requisição
   * @method setResponse
   * @param array            $response
   */
  public function setResponse($response = []){
    $this->response = $response;
  }

}
