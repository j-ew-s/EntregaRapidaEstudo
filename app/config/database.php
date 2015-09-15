<?php

//https://github.com/illuminate/database#usage-instructions
// Database configuration
$settings = array(
  'driver'    => 'mysql',
  'host'      => 'localhost',
  'database'  => 'entregarapida',
  'username'  => 'root',
  'password'  => '',
  'charset'   => 'utf8',
  'collation' => 'utf8_unicode_ci',
  'prefix'    => ''
);

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection( $settings );
$capsule->bootEloquent();
$capsule->setAsGlobal();