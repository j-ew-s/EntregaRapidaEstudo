<?php

class Empresas extends Illuminate\Database\Eloquent\Model
{
  protected $table = 'empresas';
 
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
  /*
  FUNÇÃO PARA INSERIR OU DAR UPDATE EM UM USUÁRIO
  */
  public function insert($empresaPost){
    
    echo("Empresa Insert");
   
    $empresa = new Empresas();
    
    $empresa->idResponsavel   		= $empresaPost["idResponsavel"];
    $empresa->nomeFantasia      	= $empresaPost["nomeFantasia"];  
    $empresa->razaoSocial         = $empresaPost["razaoSocial"];
    $empresa->idTipoPessoa     		= $empresaPost["idTipoPessoa"];
    $empresa->cpf            		  = $empresaPost["cpf"];
    $empresa->cnpj           		  = $empresaPost["cnpj"];
    $empresa->inscricaoestadual 	= $empresaPost["inscricaoestadual"];
  	$empresa->inscricaomunicipal 	= $empresaPost["inscricaomunicipal"];
  	$empresa->descricao 			    = $empresaPost["descricao"];
  	$empresa->datacriacao 			  = $empresaPost["datacriacao"];
  	$empresa->dataalteracao 		  = $empresaPost["dataalteracao"];
  	$empresa->observacao 			    = $empresaPost["observacao"];
    $empresa->excluido 				    = $empresaPost["excluido"];
  	$empresa->taxaentrega 			  = $empresaPost["taxaentrega"];
  	$empresa->retirarbalcao	 		  = $empresaPost["retirarbalcao"];
      
    $empresa->save();
         
    return $empresa->id;
  }
  
  // RETORNA USUÁRIOS BASEADO NO DIGITADO
  public function selectEmpresa($search)
  {
    echo($search);
    $empresa = new Empresas();
    
    if ( $search ) { 
      $usuario = $usuario->where('nomeFantasia', 'like', '%'.$search.'%')
                         ->orwhere('razaoSocial', 'like', '%'.$search.'%')
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