<?php
$app->get('/api/v1/guitars', function() use ($app) {

  $results = [];
  $description = $app->request->get('description');
  if ( $description ) {
    $results = Guitars::with('Brand')
                      ->with('Serie')
                      ->where('description','LIKE',"%{$description}%")
                      ->get();
  } else {
    $results = Guitars::with('Brand')
                      ->with('Serie')
                      ->get();
  }
  $message = $results->count() . ' results';
  return helpers::jsonResponse(false, $message, $results );

});

$app->post('/api/v1/guitars', function() use ($app){
  
  $guitar = $app->request->post('nome');
  
  
  
});