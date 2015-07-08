<?php

# === api
# ==================================================
$app->get('/api/v1/brands', function() use ($app) {

  $results = Brands::all();
  return helpers::jsonResponse(false, 'results', $results );

});

$app->get('/api/v1/series', function() use ($app) {

  $results = Series::all();
  return helpers::jsonResponse(false, 'results', $results );

});
