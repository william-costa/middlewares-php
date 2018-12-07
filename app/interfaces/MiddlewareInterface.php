<?php

namespace App\interfaces;

interface MiddlewareInterface{

  public function process(RequestInterface $request, MiddlewareInterface $delegate);

}
