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
  public function selectEmpresa($search){
      echo($search);
      $empresa = new Empresas();
      
      if ( $search ) { 
        $empresa = $empresa->where('nomeFantasia', 'like', '%'.$search.'%')
                           ->orwhere('razaoSocial', 'like', '%'.$search.'%')
                           ->get();                   
      } else {
        $empresa = $empresa->get();
      }
      
      return $empresa; 
  }
  
    
  /* 
  *  AÇÃO:    VERIFICA SE DADOS PASSADOS JÁ SÃO UTILIZADOS
  *  ENTRADA: POST DA EMPRESA
  *  SAIDA:   STATUS
  */
  public function VerificaEmpresaDuplicada($empresaPost){
      $empresas = new Empresas();
      
      if (!empty( $empresaPost)) { 
        
        $emp = $empresas->select("id")->where("cnpj","like", $empresaPost["cnpj"])
                                      ->orwhere("cpf","like", $empresaPost["cpf"])
                                      ->orwhere("nomeFantasia","like", $empresaPost["nomeFantasia"])
                                      ->orwhere("razaoSocial","like", $empresaPost["razaoSocial"])->get();   
        
        
        if(empty($emp[0])) { //NAO EXISTE EMPRESA COM ALGUM DAQUELES DADOS   
          return 1;
        } 
        else{ //JA EXISTE EMPRESA COM ESTES DADOS
          echo($emp[0]);
          return 0;
        }                  
      } 
      else
      { //DADOS VAZIOS
        return 0;
      }         
  }
  
}