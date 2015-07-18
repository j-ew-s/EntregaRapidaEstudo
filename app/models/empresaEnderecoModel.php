<?php

class EmpresaEndereco extends Illuminate\Database\Eloquent\Model
{
  protected $table = 'empresaendereco';
 
 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
  /*
   *  ACAO    : INSEIR EMRESA E ENDERECO
   *  ENTRADA : ID DA EMPRESA ID DO ENREDECO
   *  SAIDA   : ID DO RELACIONAENTO
  */
  public function insert($empresaId, $endId){
      
    echo("EMPRESA ENDERECO");
   
    $empresaEndereco = new EmpresaEndereco();
    
    $empresaEndereco->idEmpresa = $empresaId;
    $empresaEndereco->idEndereco = $endId;  
      
    $empresaEndereco->save();
         
    return $empresaEndereco->id;
  }
  
  public function select (){}
  
  
}