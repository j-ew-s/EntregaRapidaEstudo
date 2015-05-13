<?php



$secret = 'supersecretpassfromserver';

function generateAuthentication(){
echo 'a'
	//return JWT::encode($token, $secret);

	return 1;

}

function confirmauthentication($token){

	$token = JWT::decode($token, $secret);
	return $token->id;
}



?>