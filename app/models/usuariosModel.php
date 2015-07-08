<?php

class Usuarios extends Illuminate\Database\Eloquent\Model
{
  protected $table = 'usuarios';
 
 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
  /*
  FUNÇÃO PARA INSERIR OU DAR UPDATE EM UM USUÁRIO
  */
  public function insertOrUpdate($usuarioPost){
    
    echo("model ");
   
    $usuario = new Usuarios();
    
    $usuario->datacriacao = $usuarioPost["datacriacao"];
    $usuario->excluido = $usuarioPost["excluido"];  
    $usuario->nome = $usuarioPost["nome"];
    $usuario->rg = $usuarioPost["rg"];
    $usuario->cpf = $usuarioPost["cpf"];
    $usuario->email = $usuarioPost["email"];
    $usuario->dataalteracao = $usuarioPost["dataalteracao"];
      
    echo($usuario->nome);
    
    $retorno = $usuario->save();
    echo("after save");
    
    return $retorno;
    //$usuario->save();
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