<?php

namespace App\request;

use App\interfaces\RequestInterface;

class HttpRequest implements RequestInterface{

  private $bodyParams = [];

  private $queryParams = [];

  private $headers = [];

  private $response = [];

  public function __construct(){
    $this->processInputPost();
    $this->queryParams = $_GET;
    $this->bodyParams  = $_POST;
    $this->headers = getallheaders();
  }

  public function processInputPost(){
    $INPUT = file_get_contents("php://input");
    if(!empty($INPUT)) $_POST = json_decode($INPUT,true);
  }

  public function getBody(){
    return $this->bodyParams;
  }

  public function getQueryParams(){
    return $this->queryParams;
  }

  public function getHeaders(){
    return $this->headers;
  }

  public function getResponse(){
    return $this->response;
  }

  public function setResponse($response = []){
    $this->response = $response;
  }

}
