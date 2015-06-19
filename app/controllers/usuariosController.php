<?php
  
$app->get('/api/v1/usuarios', function() use ($app) {

  $results = [];
  $description = $app->request->get('description');

  $message = $results->count() . ' results';
  return helpers::jsonResponse(false, $message, $results );

});

$app->post('/api/v1/usuarios', function() use ($app){

  $guitar = $app->request->post('nome');
  $message =  "as";
  return  helpers::jsonResponse(false, $message, $guitar );
  
});