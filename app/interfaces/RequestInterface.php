<?php

namespace App\interfaces;

interface RequestInterface{

  public function __construct();

  public function getBody();

  public function getQueryParams();

  public function getHeaders();

  public function getResponse();

  public function setResponse($response = []);

}
