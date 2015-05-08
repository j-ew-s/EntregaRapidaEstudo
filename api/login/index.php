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
$app->get('/', function () {
	echo "SlimProdutos ";
});
// calling function
$app->get('/categorias','getCategorias');

//GET REQUEST WITH PARAMETERS
$app->get('/login', function () use ($app) {
	//RECIEVE PARAMETERS FROM GET
   	$nomeUsuario= $app->request()->get('nome');
   	$senha = $app->request()->get('senha');
	try{
	   	//START A CONNECTION AND EXECUTE SQL VIA PDO
	   	$conn = getConn();
		$sql = "SELECT U.id,
					   U.nome
				FROM Acessos A
				INNER JOIN Usuarios U ON U.id = A.idUsuario 
				WHERE A.nomeUsuario = :nomeUsuario 
					AND A.senha = :senha
					AND U.excluido = 0";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam("nomeUsuario",$nomeUsuario);
		$stmt->bindParam("senha",$senha);
		$stmt->execute();
		$acesso = $stmt->fetchObject();
		//RESPONSE SUCCESS
		echo $_GET['callback'] . "({result:".json_encode($acesso)."})";
	}
	catch (Exception $e) {
    	//RESPONSE ERROR
		echo $_GET['callback'] . "({result:".json_encode($e->getMessage())."})";
	}
});

function getCategorias()
{
	$stmt = getConn()->query("SELECT * FROM Categorias");
	$categorias = $stmt->fetchAll(PDO::FETCH_OBJ);
	echo "{categorias:".json_encode($categorias)."}";
};


$app->run();