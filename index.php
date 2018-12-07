<?php

ini_set("display_errors",true);

header('Content-type: application/json');

require __DIR__.'/vendor/autoload.php';

use \App\middlewares\queue\MiddlewareQueue;

try{

  echo (new MiddlewareQueue)->run(new \App\request\HttpRequest(),MiddlewareQueue::getMap('default'));

}catch(Exception $e){
  http_response_code($e->getCode());
  die(json_encode(['error'=>$e->getMessage()],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}
