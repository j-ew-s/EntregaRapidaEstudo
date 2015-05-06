<?php

require '../../vendor/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->response()->header('Content-Type', 'application/json;charset=utf-8');

// DATA BASE CONNECTION
function getConn()
{
	return new PDO('mysql:host=localhost;dbname=EntregaRapida',
	'root',
	'aesgep13',
	array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	);

};

//ROUTES
//default route
//GET REQUEST WITH PARAMETERS
$app->get('/', function () use ($app) {
	//RECIEVE PARAMETERS FROM GET

	try{
	   	//traz itens para o menu
	   	$conn = getConn();
		$sql = "SELECT 	C.id as idClassificacoes,
   						I.id as idItem,
    					I.titulo as itemTitulo,
    					TC.id as idTipoCategoria,
    					TC.titulo as tipoCategoriaTitulo,
    					CA.id as idCategoria,
    					CA.titulo as categoriaTitulo,
    					G.id as idGenero, 
    					G.titulo as generoTitulo
				FROM Classificacoes C
				INNER JOIN Item I ON I.id = C.idItem
				INNER JOIN TipoCategoria TC ON TC.id = C.idTipoCategoria
				INNER JOIN Categorias CA ON CA.id = C.idCategoria
				INNER JOIN Generos G ON G.id = C.idGenero";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$menu = $stmt->fetchObject();


		//RESPONSE SUCCESS
		echo $_GET['callback'] . "({result:".json_encode($menu)."})";
	}
	catch (Exception $e) {
    	//RESPONSE ERROR
		echo $_GET['callback'] . "({result:".json_encode($e->getMessage())."})";
	}
});



$app->run();