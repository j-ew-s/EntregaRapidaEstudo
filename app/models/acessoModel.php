<?php

class Acessos extends Illuminate\Database\Eloquent\Model
{
  protected $table = 'acessos';
 
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
  /*
  FUNÇÃO PARA INSERIR OU DAR UPDATE EM UM USUÁRIO
  */
  public function insert($usuarioPost, $usuId){
    
    echo("   ->  Entrou Insert acesso ");
   
    $acesso = new Acessos();
    
    $acesso->nomeUsuario   = $usuarioPost["login"];
    $acesso->senha         = md5($usuarioPost["senha"]);  
    $acesso->idUsuario     = $usuId;
     
    $acesso->save();
         
    return $acesso->id;
  }
      
  /* 
  *  AÇÃO:    VERIFICA SE LOGIN JÁ É UTILIZADO
  *  ENTRADA: LOGIN
  *  SAIDA:   STATUS
  */
  public function VerificaAcessoDuplicado($login)
  {
    $acesso = new Acessos();
  
    if (!empty($login)) { 
      
      $acessoId = $acesso->select("id")->where("nomeUsuario" ,"like" ,$login)->get();   
     
      if(empty($acessoId[0])) {
        return 1;
      } 
      else{
        return 0;
      }                
    } 
    else
    {
      return 0;
    }     
    
  }
  
}