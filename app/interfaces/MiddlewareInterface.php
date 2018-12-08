<?php
/**
 * Interface de Middlewares
 *
 * @author William Costa
 */

namespace App\interfaces;

interface MiddlewareInterface{

  /**
   * Métod responsável por executar as ações do middleware
   * @method process
   * @param  RequestInterface    $request
   * @param  MiddlewareInterface $delegate
   * @return mixed
   */
  public function process(RequestInterface $request, MiddlewareInterface $delegate);

}
