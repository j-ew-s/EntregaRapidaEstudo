<?php
require_once _APP . "/models/produtoModel.php";

class ProdutoBusiness {
	
	
	/*
	*  AÇÃO:     LISTAR PRODUTOS DE ACORDO COM A BUSCA
	*  ENTRADA:  PARAMETROS DA BUSCA ENVIADOS POR POST
	*  SAIDA:    RESULTADO DA BUSCA NA TABELA PRODUTOS E PRODUTODETALE
	*/
	public function get($query){
      // INSTANCIA O OBJ
      $produto = new Produto();
      // FAZ PESQUISA
      $result =  $produto->get($query);	
	  // RETORNA O RESULTADO
	  return $result;
	}	
	/*
	* AÇÃO:    
	* ENTRADA: 
	* SAIDA:   
	*/
	public function AddProduto($postProduto){
		// CRIA VARIAVEL DE RETORNO
		$retorno;
		// CRIA PRODUTO
		$produto = validaCriacaoProduto($postProduto);
		// CRIA PRODUTODETALHE  (ARRAY OU NÃO)
		$produtoDetalhe = validaCriacaoProdutoDetalhe($postProduto);
		// INSTANCIA O MODELO PRODUTO
		$produtos = new Produto();
		// VEFICA SE HA DADOS VÁLIDOS DO PRODUTO
		$validoProduto($produto);
		$validPoordutoDetalhe($produtoDetalhe);
		// SALVA PRODUTO
		if($validoProduto and $validPoordutoDetalhe){
			
			$produtoID = $produtos.insertProduto($produto);
			
			if($produtoID > 0){
				$produtoPost["idProduto"] = $produtoid;
				$produtoDetalheID = $produtos.insertProdutoDetalhe($produtoDetalhe);
				
				if($produtoDetalheID > 0){
					$retorno = array( 'mensagem'=> '2 - Não foi possível salvar o produto detalhe',
							  'status' => '500');
				}
				else{
					$retorno = array( 'mensagem'=> 'Cadastro realizado com sucesso!',
							  'status' => '200');
				}
			}
			else{
				$retorno = array( 'mensagem'=> '1 - Não foi possível salvar o produto',
							  'status' => '500');
			}
			
		}
		else{
			$retorno = array( 'mensagem'=> 'dados enviados não estão de acordo com o formato dos campos',
							  'status' => '403');
		}
		
		return $retorno;
		// SALVA DETALHE PRODUTO
	}
	
	public function validaCriacaoProduto($produto){
		// CONFIGURE DATETIME
		$date = date('m/d/Y h:i:s a', time());
		// CRIATE A ARRAY AND RETURN IT
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
			'excluido'            => 0				
		);
	}	
	
	public function validaCriacaoProdutoDetalhe($produto){
		// CONFIGURE DATE AND TIME
		$date = date('m/d/Y h:i:s a', time());
		// DECLARE AN ARRAY;
		$produtosDetalhe;
		foreach	($produto as $obj){
		// CRIATE A NEW ARRAY ITEM TO ADD IN A ARRAY COLLECTION
		// http://php.net/manual/pt_BR/function.array-push.php
		array_push($produtosDetalhe, array(
			'quantidade'        => $obj->app->request->params("quantidade", false),
			'cor'             	=> $obj->app->request->params("cor", false),
			'tamanho'      		=> $obj->app->request->params("tamanho", false),
			'valor'            	=> $obj->app->request->params("valor", false),
			'idProduto'         => 0,
			'dataAlteracao'     => $date,
			'dataCriacao'       => $date,
			'excluido'          => 0
			));
		};
		
		return $produtoDetalhe;
	}
	
	public function validaDados($validar){
		// VALIDA OS INT
		
		// VALIDA STRING
		
		// VALIDA SQL INJECTION
		
	}
	
}