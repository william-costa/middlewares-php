<?php

ini_set("display_errors",true);

include __DIR__.'/vendor/autoload.php';

$successHandler = new App\Http\Requests\SuccessRequestHandler();

$app = new App\Http\Requests\QueueRequestHandler($successHandler);

$app->add(new App\Http\Middlewares\HttpMethodMiddleware('POST'))
    ->add(new App\Http\Middlewares\AuthorizationMiddleware())
    ->add(new App\Http\Middlewares\BodyParamsMiddleware([
                                                          'nome'=>'string',
                                                          'valor'=>'numeric'
                                                        ]));

echo $app->handle(App\Http\Requests\ServerRequestFactory::createServerRequestFromGlobals());
