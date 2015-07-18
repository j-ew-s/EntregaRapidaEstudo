<?php

class UsuarioEndereco extends Illuminate\Database\Eloquent\Model
{
  protected $table = 'usuarioenredeco';
 
 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
  /*
   *  ACAO    : INSEIR USUARIO E ENDERECO
   *  ENTRADA : ID DO USUARIO ID DO ENREDECO
   *  SAIDA   : ID DO RELACIONAENTO
  */
  public function insert($usuId, $endId){
      
    echo("USUARIO ENDERECO");
   
    $usuarioEndereco = new UsuarioEndereco();
    
    $usuarioEndereco->idUsuario = $usuId;
    $usuarioEndereco->idEndereco = $endId;  
      
    $usuarioEndereco->save();
         
    return $usuarioEndereco->id;
  }
  
  public function select (){}
  
  
}