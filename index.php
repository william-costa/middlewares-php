<?php

ini_set("display_errors",true);

include __DIR__.'/vendor/autoload.php';

use App\Http\Requests\SuccessRequestHandler;
use App\Http\Requests\QueueRequestHandler;
use App\Http\Middlewares\HttpMethodMiddleware;
use App\Http\Middlewares\AuthorizationMiddleware;
use App\Http\Middlewares\BodyParamsMiddleware;
use App\Http\Requests\ServerRequestFactory;

//HANDLER DE SUCESSO (RESPONSE)
$successHandler = new SuccessRequestHandler();

//MIDDLEWARES
$app = (new QueueRequestHandler($successHandler))->add(new HttpMethodMiddleware('POST'))
                                                 ->add(new AuthorizationMiddleware())
                                                 ->add(new BodyParamsMiddleware([
                                                                                  'nome'=>'string',
                                                                                  'valor'=>'numeric'
                                                                                ]));
//RESPONSE
echo $app->handle(ServerRequestFactory::createServerRequestFromGlobals());
