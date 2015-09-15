<?php


use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model;


class Produto{
	// BASES DE DADOS
	protected $table = 'produtos';
	
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;       

	/*
    * ACAO    : BUSCAR PRODUTOS
    * ENTRADA : QUERY DE BUSCA: QUALQUER INFORMAÇÃOPASSADA PELO USUÁRIO PASSADA NA PESQUISA
    * SAIDA   : LISTA DE TODOS OS PRODUTOS COM LIGAÇÃO PELA PESQUISA OU LISTA TODOS OS PRODUTOS CADASTRADOS
    */	  
    public function get($query){

         if(is_null($query)){
            $produtos =   DB::select('select * from produtos');
         }else{
          //  $produtos =   DB::select('select * from produtos titulo = ? || descricao = ?', [$query,$query]);   
          $produtos = DB::table('produtos')
                    ->where('titulo', 'like', '%'.$query.'%')
                    ->orWhere('descricao','like', '%'.$query.'%')
                    ->get();
         }
         
        return $produtos;
    }
    /*
    * ACAO    : SALVAR OS PRODUTOS DE ACORDO COM O ID DA EMPRESA E USUARIO QUE ESTA CADASTRANDO
    * ENTRADA : DADOS VINDOS DO POST SOBRE PRODUTOS
    * SAIDA   : ID DO PRODUTO CADASTRADO 
    */
    public function insertProduto($produtoPost){
     
		$produtos = new Produtos();
		
		$produtos->idEmpresa 		= $produtoPost["idEmpresa"];
		$produtos->idMarca 			= $produtoPost["idMarca"];
		$produtos->idSubCategoria 	= $produtoPost["idSubCategoria"];
		$produtos->idGenero 		= $produtoPost["idGenero"];
		$produtos->idAutor 			= $produtoPost["idAutor"];  
		$produtos->titulo 			= $produtoPost["titulo"];
		$produtos->descricao 		= $produtoPost["descricao"];
		$produtos->dataCriacao 		= $produtoPost["dataCriacao"];
		$produtos->dataAlteracao 	= $produtoPost["dataAlteracao"];
		$produtos->excluido 		= $produtoPost["excluido"]; 
		         
		$produtos->save();
		
		return $produtos->id;     
    }
	/*
    * ACAO    : SSLVA PRODUTO DETALHE DOS PRODUTOS CADASTRADOS
    * ENTRADA : DADOS VINDOS DO POST SOBRE PRODUTOS
    * SAIDA   : ID DO PRODUTO DETALHE CADASTRADO
    */
    public function insertProdutoDetalhe($produtoPost){
     
		$produtosDetalhe = new Produtos();
		
		$produtosDetalhe->idEmpresa 		= $produtoPost["idEmpresa"];
		$produtosDetalhe->quantidade 		= $produtoPost["quantidade"];
		$produtosDetalhe->cor 				= $produtoPost["cor"];
		$produtosDetalhe->tamanho 			= $produtoPost["tamanho"];
		$produtosDetalhe->valor 			= $produtoPost["valor"];
		$produtosDetalhe->dataCriacao 		= $produtoPost["dataCriacao"];
		$produtosDetalhe->dataAlteracao 	= $produtoPost["dataAlteracao"];
		$produtosDetalhe->idProduto 		= $produtoPost["idProduto"]; 
		$produtosDetalhe->excluido 			= $produtoPost["excluido"]; 
		         
		$produtos->save();
		
		return $produtos->id;     
    }
  }