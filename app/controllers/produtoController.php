<?php

require_once _APP . "/models/appModels.php";
require_once _APP . "/business/ProdutoBusiness.php";

class ProdutoController extends BaseController {

  /*
  *  AÇÃO:     LISTAR PRODUTOS DE ACORDO COM A BUSCA
  *  ENTRADA:  PARAMETROS DA BUSCA ENVIADOS POR POST
  *  SAIDA:    RESULTADO DA BUSCA NA TABELA PRODUTOS E PRODUTODETALE
  */
  public function getProduto(){
      // BUSCA O PARAMETRO DE BUSCA
      $query = $this->app->request->params("search", false);
      // INSTANCIA O OBJ
      $produtoBusiness = new ProdutoBusiness();
      //$produto = new Produtos();
      // FAZ PESQUISA
      $result = $produtoBusiness->get($query);
      $message = "200";
      //$result =  $produto->get($query);
      // RETORNA NO FORMATO JSON O OBJETO RETORNADO
      return  helpers::jsonResponse(false, $message, $result );
  }
  /*
  *   AÇÃO:    ADICIONAR NOVOS USUÁRIOS, ENDEREÇO E USUARIO-ENDEREÇO
  *   ENTRADA: PARAMETROS DO POST
  *   SAIDA:   RETURN DO STATUS APÓS SALVAR
  */  
  public function addProdutos(){ 

      //BUSCA OS PARAMETROS
      //$produtosPost =  $this->getParametersToInsertprodutos()
      
      $produtosBussiness  = ProdutosBusiness();
     
     
      //RETORNA MENSAGEM DE SUCESSO OU ERRO
      $message = "E-mail informado já existe para outro usuário.";
      $status ="";  
      
      //RETORNA JSON PARA O FRONT
      return  helpers::jsonResponse(false, $message, $status );
  }
    public function AddProdutosDetalhe($produtosDetalhe, $produtoId){ 

      //BUSCA OS PARAMETROS
      //$produtosPost =  $this->getParametersToInsertprodutos()
      
      $produtosBussiness  = ProdutosBusiness();
     
     
      //RETORNA MENSAGEM DE SUCESSO OU ERRO
      $message = "E-mail informado já existe para outro usuário.";
      $status ="";  
      
      //RETORNA JSON PARA O FRONT
      return  helpers::jsonResponse(false, $message, $status );
  }
  /*
  *  AÇÃO:    FUNÇÃO PARA RETORNAR ARRAY DE PARAMETROS PASSADOS PELO FORM
  *  ENTRADA: PARAMETROS ENVIADOS POR POST
  *  SAIDA:   ARRAY DOS PARAMETROS ENVIADOS POR POST
  */
  private function getParametersToInsertProdutos() {
     
      // CONFIGURA A DATA E HORA
      $date = date('m/d/Y h:i:s a', time());
     
      // CRIA O ARRAY E RETORNA
      return array(
    
          'idEmpresa'           => $this->app->request->params("idEmpresa", false),
          'idMarca'             => $this->app->request->params("idMarca", false),
          'idSubCategoria'      => $this->app->request->params("idSubCategoria", false),
          'idGenero'            => $this->app->request->params("idGenero", false),
          'idAutor'             => $this->app->request->params("idAutor", false),
          'titulo'              => $this->app->request->params("titulo", false),
          'descricao'           => $this->app->request->params("descricao", false),
          'dataAlteracao'       => $date,
          'dataCriacao'         => $date,
          'excluido'            => 0,
          
          
      );
  }
  
}