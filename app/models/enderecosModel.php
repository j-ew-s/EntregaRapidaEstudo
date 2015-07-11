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
      
    /* FUNÇÃO PARA INSERIR OU DAR UPDATE EM UM USUÁRIO */
    
    public function get($query){
      
      echo("getEndereco!");
       return "200";
    }
    
    public function insert($enderecoPost){
     
        echo("Entrou Insert Endereco");
       
        $endereco = new Enderecos();
        
        $endereco->rua = $enderecoPost["rua"];
        $endereco->bairro = $enderecoPost["bairro"];  
        $endereco->cep = $enderecoPost["cep"];
        $endereco->numero = $enderecoPost["numero"];
        $endereco->complemento = $enderecoPost["complemento"];
        $endereco->excluido = $enderecoPost["excluido"]; 
                 
       $endereco->save();
       
       return $endereco->id;
        
    
    }
  
  }