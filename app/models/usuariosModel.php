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
  public function insert($usuarioPost){
    
    echo("Entrou Insert Usuario ");
   
    $usuario = new Usuarios();
    
    $usuario->datacriacao   = $usuarioPost["datacriacao"];
    $usuario->excluido      = $usuarioPost["excluido"];  
    $usuario->nome          = $usuarioPost["nome"];
    $usuario->sobrenome     = $usuarioPost["sobrenome"];
    $usuario->rg            = $usuarioPost["rg"];
    $usuario->cpf           = $usuarioPost["cpf"];
    $usuario->email         = $usuarioPost["email"];
    $usuario->dataalteracao = $usuarioPost["dataalteracao"];
      
    $usuario->save();
         
    return $usuario->id;
  }
  
  // RETORNA USUÁRIOS BASEADO NO DIGITADO
  public function selectUser($search)
  {
    echo($search);
    $usuario = new Usuarios();
    
    if ( $search ) { 
      $usuario = $usuario->where('nome', 'like', '%'.$search.'%')
                         ->orwhere('sobrenome', 'like', '%'.$search.'%')
                         ->get();                   
    } else {
      $usuario = $usuario->get();
    }
    
    return $usuario;
    
  }
  
}