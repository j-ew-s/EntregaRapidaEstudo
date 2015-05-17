<?php

require '../../vendor/Slim/Slim.php';
require '../../vendor/JWT/JWT.php';

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

//GET REQUEST WITH PARAMETERS
$app->post('/login', function () use ($app) {
	//RECIEVE PARAMETERS FROM GET
   	$nomeUsuario= "gabriel.scavassa";//$app->request()->get('nome');
   	$senha = "123";//$app->request()->get('senha');
   	//	$nomeUsuario= $app->request()->get('nome');
   //	$senha = $app->request()->get('senha');
	try{

	   	//START A CONNECTION AND EXECUTE SQL VIA PDO
    	$conn = getConn();

		$sql = "SELECT U.id,
					   U.nome,
					   NOW() + INTERVAL 30 MINUTE as date
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

		//RESPONSE WITH JWT FORMAT ARCHIVE
		$acesss = JWT::encode($acesso, 'acesso');
		//echo "{result:".json_encode($acesss)."}";
		echo "({result:".json_encode($acesss)."})";
		//echo "{categorias:".json_encode($acesss)."}";
		//echo $_GET['callback'] . "({result:".json_encode($acess)."})";

	}
	catch (Exception $e) {
    	//RESPONSE ERROR
		echo $_GET['callback'] . "({result:".json_encode($e->getMessage())."})";
	}
});


//GET parameters from Header and send back to APP
$app->get('/logout', function () use ($app) {
	$headers = apache_request_headers();
//GET THE HEADERS FROM REQUEST
foreach ($headers as $header => $value) {
    echo "$header: $value <br />\n";
    if($header == "Connection"){

    	echo " !!!!  $header\n";
    }
}
});



$app->run();