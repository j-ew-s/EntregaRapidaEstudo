<?php

use Slim\Slim as Slim;

class BaseController {

  public $app;

  function __construct() {
    $this->app = Slim::getInstance();
  }

  public function autenticate() {

    // Verifica se o usuário está logad
	

  }
  
}