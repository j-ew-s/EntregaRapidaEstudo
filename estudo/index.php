<?php

//Instanciate  Slim framework
require '../vendor/Slim/Slim.php';
require '../vendor/RedBean/rb.php';

// set up database connection
/*R::setup('mysql:host=localhost;dbname=EntregaRapida','root','aesgep13');
R::freeze(true);
*/
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();


//Create the response header
$app->response()->header('Content-Type', 'application/json;charset=utf-8');

//Create the path to the functions
$app->get('/categorias','getCategorias');
$app->post('/produtos','addProdutos');
$app->get('/produtos/:id','getProduto');
//$app->post('/login', 'getAcesso');

// handle get requests to /login
$app->get('/login(/:login/:senha)', function ($login, $senha) use ($app) 
{    
  try {
		$nomeUsuario = $login;
		$senha = $senha;

		// query database for single article
		//$acesso = R::findOne('Acessos', 'nomeUsuario=?', $nomeUsuario, 'senha=?',$senha);
		$acesso =  R::getAll(' SELECT * FROM Acessos WHERE nomeUsuario = '+ $nomeUsuario +' AND senha = '+ $senha );

		if ($article) {
		  // if found, return JSON response
		  $app->response()->header('Content-Type', 'application/json');
		  echo json_encode(R::exportAll($acesso));
		} else {
		  // else throw exception
		  throw new ResourceNotFoundException();
		}
  }   
  catch (ResourceNotFoundException $e) {
    // return 404 server error
    	$app->response()->status(404);
  }   
  catch (Exception $e) {
    	$app->response()->status(400);
    	$app->response()->header('X-Status-Reason', $e->getMessage());
  }
});


 /*function getAcesso()
 {
	$request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body); 

	$senha = sha1($input->senha);
	$nomeUsuario = $input->login;

	try{
		//transforma senha
		$senha = sha1($senha);
		// verifica autenticiade
		$conn = getConn();
		$sql = "SELECT * FROM Acessos WHERE nomeUsuario = :nomeUsuario AND senha = :senha";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam("nomeUsuario",$nomeUsuario);
		$stmt->bindParam("senha",$senha);
		$stmt->execute();
		$usuario = $stmt->fetchObject();
		// caso usuário exista
		//echo json_encode($state);
		//echo ($sql);
		 $app->response()->header('Content-Type', 'application/json');
		echo json_encode($state);

	} catch (Exception $e) {
	    	
	    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
	}

});*/
//$app->get('/', 'getCategorias');

$app->get('/', function () {
	//echo "SlimProdutos ";
	$str = "123";
	echo sha1($str);
});

//Start app
$app->run();


//Description: Creates a connection with mysql database
function getConn()
{
	return new PDO('mysql:host=localhost;dbname=SlimProdutos',
	'root',
	'aesgep13',
	array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	);

}

//faz login
function getAcesso($senha, $nomeUsuario)
{
	$senha = sha1($senha);

	try{
		//transforma senha
		$senha = sha1($senha);
		// verifica autenticiade
		$conn = getConn();
		$sql = "SELECT * FROM Acessos WHERE nomeUsuario = :nomeUsuario AND senha = :senha";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam("nomeUsuario",$nomeUsuario);
		$stmt->bindParam("senha",$senha);
		$stmt->execute();
		$usuario = $stmt->fetchObject();
		// caso usuário exista
		if($usuario)
		{
			$state = 
		}
		//caso usuário não exista
		else
		{
			$state = 
		}
		echo json_encode($state);
		//echo ($sql);

	} catch (Exception $e) {
	    	
	    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
	}

}



//Description: Return all itens from Categorias table
function getCategorias()
{
	$stmt = getConn()->query("SELECT * FROM Categorias");
	$categorias = $stmt->fetchAll(PDO::FETCH_OBJ);
	echo "{categorias:".json_encode($categorias)."}";
}

//Description: Add a new Product in Produtos table, 
//Related with Categorias table (ref idCategoria)
function addProdutos()
{
	try{
	$dataAtual = date("d/m/Y");
	$request = \Slim\Slim::getInstance()->request();
	$produto = json_decode($request->getBody());
	$sql = "INSERT INTO produtos (nome,preco,dataInclusao,idCategoria) 
	        values (:nome,:preco,:dataInclusao,:idCategoria)";
	$conn = getConn();
	$stmt = $conn->prepare($sql);
	$stmt->bindParam("nome",$produto->nome);
	$stmt->bindParam("preco",$produto->preco);
	$stmt->bindParam("dataInclusao",$dataAtual);
	$stmt->bindParam("idCategoria",$produto->idCategoria);
	$stmt->execute();

	$produto->id = $conn->lastInsertId();

	echo json_encode($produto);

	} catch (Exception $e) {
	    	
	    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
	}
	

}

//Description: Return all the itens from Produtos by produto Id
//Parameters: Produto ID
function getProduto($id)
{
	$id = 1;
	try{
		$conn = getConn();
		$sql = "SELECT * FROM produtos WHERE id=:id";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam("id",$id);
		$stmt->execute();
		$produto = $stmt->fetchObject();
			
		//categoria
		$sql = "SELECT * FROM categorias WHERE id=:id";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam("id",$produto->idCategoria);
		$stmt->execute();
		$produto->categoria = $stmt->fetchObject();

		echo json_encode($produto);

	} catch (Exception $e) {
	    	
	    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
	}
	
}