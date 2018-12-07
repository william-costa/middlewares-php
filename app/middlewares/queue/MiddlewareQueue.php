<?php

namespace App\middlewares\queue;

use App\interfaces\MiddlewareInterface;
use App\interfaces\RequestInterface;

class MiddlewareQueue implements MiddlewareInterface{

  public function run(RequestInterface $request,$map = []){
    if(empty($map)){
      throw new \Exception('O mapa de middlewares foi finalizado mas não teve um retorno correto', 400);
    }
    $middleware = array_shift($map);
    $request->middlewareMap = $map;
    return (new $middleware)->process($request,$this);
  }

  public function process(RequestInterface $request, MiddlewareInterface $delegate){
    return $this->run($request,$request->middlewareMap);
  }

  public static function getMap($map){
    if(!file_exists(__DIR__.'/maps/'.$map.'.php')){
      throw new \Exception('O mapa de middlewares "'.$map.'" não foi encontrado', 400);
    }
    return require(__DIR__.'/maps/'.$map.'.php');
  }

}
