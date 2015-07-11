<?php

//require_once "../models/usuariosModel.php";
require_once _APP . "/models/appModels.php";

class UsuariosController extends BaseController {
  
  public function getAllUsuarios(){
 
      $search = $this->app->request->params("search", false);
      
      $usu = new Usuarios();
      $response =  $usu->selectUser($search);
      
      $message = "";
      
      return  helpers::jsonResponse(false, $message, $response );
  }
  /*
  *  AÇÃO:     LISTAR USUÁRIOS DE ACORDO COM A BUSCA
  *  ENTRADA:  PARAMETROS DA BUSCA ENVIADOS POR POST
  *  SAIDA:    RESULTADO DA BUSCA NA TABELA USUÁRIO E O STATUS DA CONSULTA
  */
  public function getUsuarios(){
      // RECEBE OS PARAMETROS DE ENTRADA
      $search = $this->app->request->params("search", false);
      // INSTANCIA A CLASSE USUÁRIO
      $usu = new Usuarios();
      // EXECUTA A CONSULTA
      $response =  $usu->selectUser($search);
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
  public function addUsuarios(){
      //BUSCA OS PARAMETROS
      $usuarioPost =  $this->getParametersToInsertUsuario();
      //SALVA O ENDEREÇO
      $end = new Enderecos();
      $endId =  $end->insert($usuarioPost);
      //SALVA O USUARIO     
      $usu = new Usuarios();
      $usuId =  $usu->insert($usuarioPost);
      //SALVA ENDERECO-USUARIO
      $usuEnd = new UsuarioEndereco();
      $usuEndResponse =  $usuEnd->insert($usuId, $endId);
      //RETORNA MENSAGEM DE SUCESSO OU ERRO
      $message = "";
      $response ="";
      //RETORNA JSON PARA O FRONT
      return  helpers::jsonResponse(false, $message, $response );
  }
  /*
  *  AÇÃO:    FUNÇÃO PARA RETORNAR ARRAY DE PARAMETROS PASSADOS PELO FORM
  *  ENTRADA: PARAMETROS ENVIADOS POR POST
  *  SAIDA:   ARRAY DOS PARAMETROS ENVIADOS POR POST
  */
  private function getParametersToInsertUsuario() {
      // CONFIGURA A DATA E HORA
      $date = date('m/d/Y h:i:s a', time());
      // CRIA O ARRAY E RETORNA
      return array(
          'nome'          => $this->app->request->params("nome", false),
          'sobrenome'     => $this->app->request->params("sobrenome", false),
          'cpf'           => $this->app->request->params("cpf", false),
          'rg'            => $this->app->request->params("rg", false),
          'email'         => $this->app->request->params("email", false),
          'dataalteracao' => $date,
          'datacriacao'   => $date,
          'excluido'      => 0,
          'cep'           => $this->app->request->params("cep", false),
          'rua'           =>$this->app->request->params("rua", false),
          'bairro'        =>$this->app->request->params("bairro", false),
          'numero'        =>$this->app->request->params("numero", false),
          'complemento'   =>$this->app->request->params("complemento", false)
      );
  }
  
}