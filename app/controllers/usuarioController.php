<?php

//require_once "../models/usuariosModel.php";
require_once _APP . "/models/appModels.php";

class UsuarioController extends BaseController {
  
  public function getAllUsuarios(){
 
      $search = $this->app->request->params("search", false);
      
      $usu = new Usuarios();
      $response =  $usu->selectUser($search);
      
      $message = "";
      
      return  helpers::jsonResponse(false, $message, $response );
  }
  /*
  *  AÇÃO:    RETORNA PAIS, ESTADO E CIDADE PARA O CADASTRO
  *  ENTRADA: 
  *  SAIDA:   LISTA DE PAIS, ESTADO E CIDADE
  */
  public function createUsuarios(){
    
      $end = new Enderecos();
      
      $response = $end.selectPaisEstadoCidade();
      
      $message = "";
      
      return  helpers::jsonResponse(false, $message, $response );  
    
  }
  /*
  *  AÇÃO:     LISTAR USUÁRIOS DE ACORDO COM A BUSCA
  *  ENTRADA:  PARAMETROS DA BUSCA ENVIADOS POR POST
  *  SAIDA:    RESULTADO DA BUSCA NA TABELA USUÁRIO E O STATUS DA CONSULTA
  */
  public function getUsuario(){
      // RECEBE OS PARAMETROS DE ENTRADA
      $search = $this->app->request->params("search", false);
      // INSTANCIA A CLASSE USUÁRIO
      $usu = new Usuario();
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
      //VALIDA EMAIL JA EXISTENTE
      $usu = new Usuarios();
      $usuEmailDuplicado =  $usu->VerificaEmailDuplicado($usuarioPost["email"]);
      echo('Resultado = ' + $usuEmailDuplicado);
      //VALIDA RESULTADO DA PESQUISA DE EMAIL
      if($usuEmailDuplicado == 1){
         echo('entrou');
          //VERIFICA SE LOGIN NÃO É DUPLICADO
          $acesso  = new Acessos();
          $acessoDuplicado = $acesso->VerificaAcessoDuplicado($usuarioPost["login"]);
          //VALIDA O RESULTADO DO ACESSO
          if($acessoDuplicado == 1){
              //INICIALIZA AS MENSAGENS
              $message = "Cadastro realizado com sucesso.";
              $status = "200";
              //SALVA O ENDEREÇO
              $end = new Enderecos();
              $endId =  $end->insert($usuarioPost);
              if($endId > 0){
                //SALVA O USUARIO     
                $usuId =  $usu->insert($usuarioPost);
                if($usuId > 0){
                  //SALVA ENDERECO-USUARIO
                  $usuEnd = new UsuarioEndereco();
                  $usuEndId=  $usuEnd->insert($usuId, $endId);
                  if($usuEndId > 0){
                    //CRIAR LOGIN DE USUÁRIO
                    $acessoId = $acesso->insert($usuarioPost,$usuId);
                    if($acessoId < 0){
                       $message = "Erro ao salvar o acesso.";
                       $status = "500";
                    }
                  }
                  else{
                    //RETORNA MENSAGEM DE SUCESSO OU ERRO
                    $message = "Erro ao salvar o relacionamento Usuário - Endereço.";
                    $status = "500";
                  }
                }
                else{
                  //RETORNA MENSAGEM DE SUCESSO OU ERRO
                  $message = "Erro ao salvar Usuário.";
                  $status = "500";
                }       
              }else{
                //RETORNA MENSAGEM DE SUCESSO OU ERRO
                $message = "Erro ao salvar Endereço";
                $status ="500";
              }
          }else{
          //RETORNA MENSAGEM DE SUCESSO OU ERRO
          $message = "Login informado já existe para outro usuário.";
          $status ="";  
        }
      }
      else{
          //RETORNA MENSAGEM DE SUCESSO OU ERRO
          $message = "E-mail informado já existe para outro usuário.";
          $status ="";  
      }
      //RETORNA JSON PARA O FRONT
      return  helpers::jsonResponse(false, $message, $status );
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
          'pais'          => $this->app->request->params("pais", false),
          'estado'        => $this->app->request->params("estado", false),
          'cidade'        => $this->app->request->params("cidade", false),
          'cep'           => $this->app->request->params("cep", false),
          'rua'           =>$this->app->request->params("rua", false),
          'bairro'        =>$this->app->request->params("bairro", false),
          'numero'        =>$this->app->request->params("numero", false),
          'complemento'   =>$this->app->request->params("complemento", false),
          'login'         =>$this->app->request->params("login", false),
          'senha'         =>$this->app->request->params("senha", false)
      );
  }
  
}