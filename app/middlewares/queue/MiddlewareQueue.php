<?php
/**
 * Gerenciador de filas de middlewares
 * Responsável executar sequencialmente os middlewares de um mapa
 *
 * @author William Costa
 */

namespace App\middlewares\queue;

use App\interfaces\MiddlewareInterface;
use App\interfaces\RequestInterface;

class MiddlewareQueue implements MiddlewareInterface{

  /**
   * Método responsável por executar o próximo middleware da fila
   * @method run
   * @param  RequestInterface $request
   * @param  array            $map
   * @return mixed
   */
  public function run(RequestInterface $request,$map = []){
    if(empty($map)){
      throw new \Exception('O mapa de middlewares foi finalizado mas não teve um retorno correto', 400);
    }
    $middleware = array_shift($map);
    $request->middlewareMap = $map;
    return (new $middleware)->process($request,$this);
  }

  /**
   * Métod responsável por executar as ações do middleware
   * @method process
   * @param  RequestInterface    $request
   * @param  MiddlewareInterface $delegate
   * @return mixed
   */
  public function process(RequestInterface $request, MiddlewareInterface $delegate){
    return $this->run($request,$request->middlewareMap);
  }

  /**
   * Método responsável por obter um mapa de midlewares
   * @method getMap
   * @param  string $map
   * @return array
   */
  public static function getMap($map){
    if(!file_exists(__DIR__.'/maps/'.$map.'.php')){
      throw new \Exception('O mapa de middlewares "'.$map.'" não foi encontrado', 400);
    }
    return require(__DIR__.'/maps/'.$map.'.php');
  }

}
