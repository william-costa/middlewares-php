<?php

namespace App\Http\Requests;

use App\Http\Responses\ResponseException;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 *
 * Implementação de RequestHandlerInterface responsavel por executar a fila de middlewares
 *
 * @author William Costa
 *
 */
class QueueRequestHandler implements RequestHandlerInterface {

    /**
     * Fila de middlewares
     * @var array
     */
    private $middleware = [];

    /**
     * Implementação de RequestHandler responsável pela resposta da requisição
     * @var RequestHandlerInterface
     */
    private $fallbackHandler;

    /**
     * Responsável por definir o fallback handler
     * @method __construct
     * @param  RequestHandlerInterface $fallbackHandler
     */
    public function __construct(RequestHandlerInterface $fallbackHandler){
        $this->fallbackHandler = $fallbackHandler;
    }

    /**
     * Método responsável por adicionar um middleware na fila
     * @method add
     * @param  MiddlewareInterface $middleware
     */
    public function add(MiddlewareInterface $middleware){
        $this->middleware[] = $middleware;
        return $this;
    }

    /**
     * Método responsável por processar a requisição e retornar uma response
     * @method handle
     * @param  ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface {
      try{

        //EXECUTA O FALLBACK APENAS QUANDO NÃO EXISTIR MAIS MIDDLEWARES NA FILA
        if (0 === count($this->middleware)) {
            return $this->fallbackHandler->handle($request);
        }

        //EXECUTA O MIDDLEWARE ATUAL
        $middleware = array_shift($this->middleware);
        return $middleware->process($request, $this);

      }catch(\Exception $e){
        return new ResponseException($e);
      }
    }
}
