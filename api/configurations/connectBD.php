<?php
/*
* Classe de conexão a banco de dados MySQL Orientado a Objetos
* Autor:  Jair Rebello
*/
 
class connectBD {
 
   function getConn()
   {
      return new PDO('mysql:host=localhost;dbname=EntregaRapida',
      'root',
      'aesgep13',
      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
      );

   };
}
 
?>