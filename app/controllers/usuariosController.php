<?php

class UsuariosController extends Usuarios {
  
  public function getUsuarios(){

    $id = 1; 
    $response =  Usuarios::selectUser($id);
    
    $message = "";
    
    return  helpers::jsonResponse(false, $message, $response );
  }
  
    
  public function addUsuarios(){
    echo("1");
    
    $usuarioPost =  $this->getParametrosUsuario();      
    echo($usuarioPost);
    $response =  Usuarios::insertOrUpdate($usuarioPost);

    $message = "";
  
    return  helpers::jsonResponse(false, $message, $id );
  }
  
  
  private function getParametrosUsuario() {
    return array(
      'nome'   => $app->request->params("nome", false),
      'cpf'   => $this->app->request->params("cpf", false),
      'rg' => $this->app->request->params("rg", false),
      'email' => $this->app->request->params("email", false),
    );
  }
 /* 
  $app->get('/api/usuarios', function() use ($app) {
  
    $results = [];
    $description = $app->request->get('description');
  
    $message = $results->count() . ' results';
    return helpers::jsonResponse(false, $message, $results );
  
  });
  
  $app->post('/api/v1/getUsuarios', function() use ($app){
    echo("Entrou 1"); 
    $id = $app->request->post('id');
    
    $response =  Usuarios::selectUser($id);
    echo ($response);
    //$message = $response->count()."Linhas";
    
    $message = "teste";
  
    return  helpers::jsonResponse(false, $message, $id );
    
  });
*/
}