<?php

class Enderecos extends Illuminate\Database\Eloquent\Model
{
  protected $table = 'enderecos';
 
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
          
    public function get($query){
      
         $endereco = DB::table('usuarioEndereco')
          ->join('enredecos', 'usuarioendereco.endId', '=','enderecos.id' )
          ->join('estado', 'pais.id', '=', 'estado.pais')
          ->join('cidade', 'esdato.id', '=', 'cidade.estado')
          ->select('enderecos.*', 'pais.nome', 'pais.sigla', 'estado.nome', 'estado.uf', 'estado.nome', 'cidade.nome')
          ->get();
          
          return $endereco;
    }
    /*
    * ACAO    :
    * ENTRADA :
    * SAIDA   :
    */
    public function insert($enderecoPost){
     
        echo("Entrou Insert Endereco");
       
        $endereco = new Enderecos();
        
        $endereco->rua = $enderecoPost["pais"];
        $endereco->rua = $enderecoPost["estado"];
        $endereco->rua = $enderecoPost["pais"];
        $endereco->rua = $enderecoPost["rua"];
        $endereco->bairro = $enderecoPost["bairro"];  
        $endereco->cep = $enderecoPost["cep"];
        $endereco->numero = $enderecoPost["numero"];
        $endereco->complemento = $enderecoPost["complemento"];
        $endereco->excluido = $enderecoPost["excluido"]; 
                 
       $endereco->save();
       
       return $endereco->id;   
    
    }
    /*
    *  AÇÃO:    RETORNAR DADOS DE PAIS ESTADO E CIDADE PARA PREENCHER FORMULPARIO DE CADASTRO
    *  ENTRADA: 
    *  SAIDA:   PAIS: ID E NOME, ESTADO: ID E UF E CIDADE: ID E NOME.
    */
    public function selectPaisEstadoCidade(){
      
      $PaisEstadoCidade = DB::table('pais')
            ->join('estado', 'pais.id', '=', 'estado.pais')
            ->join('cidade', 'esdato.id', '=', 'cidade.estado')
            ->select('pais.id','pais.nome', 'estado.id','estado.uf', 'cidade.id','cidade.nome')
            ->get();
            
      if($PaisEstadoCidade){
        return $PaisEstadoCidade;
      }
      else{
        return "Status: 500";
      }
    }
  
  }