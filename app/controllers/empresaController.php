<?php

//require_once "../models/usuariosModel.php";
require_once _APP . "/models/appModels.php";

class EmpresaController extends BaseController {
  
  public function getAllEmpresas(){
      
      $search = $this->app->request->params("search", false);
      
      $emp = new Empresas();
      $response =  $emp->SelectEmpresas($search);
      
      $message = "";
      
      return  helpers::jsonResponse(false, $message, $response );
  }
  /*
  *  AÇÃO:     LISTAR USUÁRIOS DE ACORDO COM A BUSCA
  *  ENTRADA:  PARAMETROS DA BUSCA ENVIADOS POR POST
  *  SAIDA:    RESULTADO DA BUSCA NA TABELA USUÁRIO E O STATUS DA CONSULTA
  */
  public function getEmpresa(){
      // RECEBE OS PARAMETROS DE ENTRADA
      $search = $this->app->request->params("search", false);
      // INSTANCIA A CLASSE USUÁRIO
       $empresa = new Empresa();
      // EXECUTA A CONSULTA
      $response =  $emp->selectEmpresa($search);
      // PREPARA A RESPOSTA
      $message = "";
      // RETORNA O RESULTADO VIA JSON
      return  helpers::jsonResponse(false, $message, $response );
  }
  /*
  *   AÇÃO:    ADICIONAR NOVOS USUÁRIOS, ENDEREÇO E USUARIO-ENDEREÇO
  *   ENTRADA: PARAMETROS DO POST
  *   SAIDA:   RETURN DO STATUS APÓS SALVAR
  */  
  public function addEmpresa(){ 
      
      //BUSCA OS PARAMETROS
      $empresaPost =  $this->getParametersToInsertEmpresas();
      //VALIDA EMAIL JA EXISTENTE
      $empresa = new Empresa();
	    //VERIFICAR CNPJ, NOME E RAZAO SOCIAL.
      $empresaDuplicada = $empresa->VerificaEmpresaDuplicada($empresaPost);
      //VALIDA RESULTADO DA PESQUISA DE DUPLICIDADE
      if($empresaDuplicada > 0){
          $message = "Cadastro realizado com sucesso.";
          $status = "200";
          //SALVA O ENDEREÇO
          $end = new Endereco();
          $endId =  $end->insert($empresaPost);
          if($endId > 0){
            //SALVA O USUARIO     
            $empresaId =  $empresa->insert($empresaPost);
            if($empresaId > 0){
              //SALVA EMPRESA - ENDERECO
              $EmpEnd = new EmpresaEndereco();
              $EmpEndId=  $EmpEnd->insert($empresaId, $endId);
              if($EmpEndId <= 0){
                //RETORNA MENSAGEM DE ERRO
                $message = "Erro ao salvar o relacionamento Usuário - Endereço.";
                $status = "500";
              }
            }
            else{
              //RETORNA MENSAGEM DE ERRO
              $message = "Erro ao salvar Usuário.";
              $status = "500";
            }       
          }else{
            //RETORNA MENSAGEM DE ERRO
            $message = "Erro ao salvar Endereço.";
            $status ="500";
          }
      }
      else{
          //RETORNA MENSAGEM DE ERRO
          $message = "Dados da empresa já existem para outra empresa.";
          $status ="";  
      }
      //RETORNA JSON PARA O FRONT
      return  helpers::jsonResponse(false, $message, $status );
  }
  /*
  *  AÇÃO:    RETORNA ARRAY DE PARAMETROS PASSADOS PELO FORM
  *  ENTRADA: PARAMETROS ENVIADOS POR POST
  *  SAIDA:   ARRAY DOS PARAMETROS ENVIADOS POR POST
  */
  private function getParametersToInsertEmpresas() {
      // CONFIGURA A DATA E HORA
      $date = date('m/d/Y h:i:s a', time());
      // CRIA O ARRAY E RETORNA
      return array(
          'idResponsavel'           => $this->app->request->params("idResponsavel", false),
          'nomeFantasia'            => $this->app->request->params("nomeFantasia", false),
          'razaoSocial'             => $this->app->request->params("razaoSocial", false),
          'idTipoPessoa'            => $this->app->request->params("idTipoPessoa", false),
          'cpf'                     => $this->app->request->params("cpf", false),
          'cnpj'                    => $this->app->request->params("cnpj", false),
          'inscricaoestadual'       => $this->app->request->params("inscricaoestadual", false),
          'inscricaomunicipal'      => $this->app->request->params("inscricaomunicipal", false),
          'descricao'               => $this->app->request->params("descricao", false),
          'observacao'              => $this->app->request->params("observacao", false),
          'taxaentrega'             => $this->app->request->params("taxaentrega", false),
          'retirarbalcao'           => $this->app->request->params("retirarbalcao", false),
          'pais'                    => $this->app->request->params("pais", false),
          'estado'                  => $this->app->request->params("estado", false),
          'cidade'                  => $this->app->request->params("cidade", false),
          'rua'                     => $this->app->request->params("rua", false),
          'bairro'                  => $this->app->request->params("bairro", false),
          'cep'                     => $this->app->request->params("cep", false),
          'numero'                  => $this->app->request->params("numero", false),
          'complemento'             => $this->app->request->params("complemento", false),
          'dataalteracao'           => $date,
          'datacriacao'             => $date,
          'excluido'                => 0
      );
  }
    /*
  *  AÇÃO:    VALIDAR CAMPOS OBRIGATÓRIOS NO CADASTRO DE EMPRESA
  *  ENTRADA: PARAMETROS ENVIADOS POR POST
  *  SAIDA:   MENSAGEM DE ERRO QUANDO INFORMAÇÃO OBRIGATÓRIA NAO EXISTIR OU MENSAGEM VAZIA QUANDO INFOS. OK
  */
  private function ValidaDadosPost($empresaPost){
    $mensagem = "";

   // VALIDA SE FOI INFORMADO O TIPO DE USUÁRIO (FISICO OU JURÍDICO)
   if(empty($empresaPost["idTipoPessoa"])) {
     
     if($empresaPost["idTipoPessoa"] == 1) {
       if(empty($empresaPost["cpf"])){
         return $mensagem = "O campo CPF para o tipo de usuário Pessoa Física é obrigatório.";
       }
     }
     if($empresaPost["idTipoPessoa"] == 2) {
        if(empty($empresaPost["cnpj"])){
         return $mensagem = "O campo CNPJ para o tipo de usuário Pessoa Jurídica é obrigatório.";
       }
     }
     else {
      return $mensagem = "O tipo de usuário deve ser Físico ou Jurídico.";
     }

   }else{
     return $mensagem = "Escolha um tipo de usuário: Físico ou Jurídico.";
   }
   
   //VALIDAR CAMPOS DO ENDEREÇO
   
   return $mensagem;
   
  }
  
}