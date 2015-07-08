<?php

//require_once "../models/usuariosModel.php";
require_once _APP . "/models/appModels.php";

class UsuariosController extends BaseController {
  
  public function getUsuarios(){

    $id = 1; 
    $usu = new Usuarios();
    $response =  $usu->selectUser($id);
    
    $message = "";
    
    return  helpers::jsonResponse(false, $message, $response );
  }
  
    
  public function addUsuarios(){
    echo("1");
    
    $usuarioPost =  $this->getParametrosUsuario();
          
    echo($usuarioPost['nome']);
    echo($usuarioPost['cpf']);
    echo($usuarioPost['rg']);
    echo($usuarioPost['email']);
    echo($usuarioPost['dataalteracao']);
    echo($usuarioPost['datacriacao']);
    echo($usuarioPost['excluido']);
          
          
    $usu = new Usuarios();
    $response =  $usu->insertOrUpdate($usuarioPost);

    $message = "";
  
    return  helpers::jsonResponse(false, $message, $response );
  }
  
  
  private function getParametrosUsuario() {
    $date = date('m/d/Y h:i:s a', time());
    return array(
      'nome'   => $this->app->request->params("nome", false),
      'cpf'   => $this->app->request->params("cpf", false),
      'rg' => $this->app->request->params("rg", false),
      'email' => $this->app->request->params("email", false),
      'dataalteracao' => $date,
      'datacriacao' => $date,
      'excluido' => 0
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