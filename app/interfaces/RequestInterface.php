<?php
/**
 * Interface de Requisições
 *
 * @author William Costa
 */

namespace App\interfaces;

interface RequestInterface{

  /**
   * Método responsável por definir a requisição atual
   * @method __construct
   */
  public function __construct();

  /**
   * Método responsável por retornar o body da requisição
   * @method getBody
   * @return array
   */
  public function getBody();

  /**
   * Método responsável por obter os dados enviados por query params
   * @method getQueryParams
   * @return array
   */
  public function getQueryParams();

  /**
   * Método responsável por obter os headers da requisição
   * @method getHeaders
   * @return array
   */
  public function getHeaders();

  /**
   * Método responsável por obter o response gerado para a requisição
   * @method getResponse
   * @return array
   */
  public function getResponse();

  /**
   * Método responsável por definir os dados da response da requisição
   * @method setResponse
   * @param array            $response
   */
  public function setResponse($response = []);

}
