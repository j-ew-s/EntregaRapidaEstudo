<?php
class Usuarios extends Illuminate\Database\Eloquent\Model
{
  protected $table = 'usuarios';
  

  /*
  FUNÇÃO PARA INSERIR OU DAR UPDATE EM UM USUÁRIO
  */
  public function insertOrUpdate( $usuarioPost){
    echo("save");
    echo($this->app->request->post());
   
    if ( $usuarioPost->id ) {
      $usuario = Usuarios::find($this->app->request->post('nome'));
   
    } else {
      $usuario = new Usuarios();
      $usuario->datacriacao = getdate();
    }
    
    $usuario->nome = $usuarioPost["nome"];
    $usuario->rg = $usuarioPost["rg"];
    $usuario->cpf = $usuarioPost["cpf"];
    $usuario->email = $usuarioPost["email"];
    $usuario->dataalteracao = getdate();
    $usuario->excluido = $usuarioPost["excluido"];
     
    $usuario->save();
    
  }
  
  // RETORNA USUÁRIOS - BASEADO EM ID OU NÃO
  public function selectUser($id = false)
  {

    if ( $id ) { 
      $usuario = Usuarios::find($id); 
    } else {
      $usuario = $table->get();
    }
    return $usuario;
    
  }
}