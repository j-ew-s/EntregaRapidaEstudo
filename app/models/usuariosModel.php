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
  
    
  /* 
  *  AÇÃO:    VERIFICA SE E-MAIL JÁ É UTILIZADO
  *  ENTRADA: EMAIL
  *  SAIDA:   STATUS
  */
  public function VerificaEmailDuplicado($email)
  {
    $usuario = new Usuarios();
    
    if (!empty( $email)) { 
      
      $usu = $usuario->select("id")->where("email","like", $email)->get();   
      
      if(empty($usu[0])) { //NAO EXISTE USUARIO COM ESTE EMAIL
        
        return 1;
      } 
      else{ //JA EXISTE USUARIO COM ESTE EMAIL
        echo($usu[0]);
        return 0;
      }                  
    } 
    else
    { //EMAIL ESTA VAZIO
      return 0;
    }         
  }
  
}