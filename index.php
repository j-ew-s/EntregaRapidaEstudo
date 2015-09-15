<?php

# === constants
# ==================================================
define("_APP", dirname(__FILE__) . '/app');

# === slim
# ==================================================
require 'vendor/autoload.php';
$app = new \Slim\Slim(array(
 'debug' => true
));

# === config
# ==================================================
require_once _APP . '/config/database.php';

# === helpers
# ==================================================
require_once _APP . '/helpers/appHelpers.php';

# === models
# ==================================================
//require_once _APP . "/models/appModels.php";
// Carrega todos os arquivos existentes dentro da pasta Models
foreach (glob( _APP ."/models/*.php") as $filename)
{
    require_once $filename;
}

# === controllers
# ==================================================
//require_once _APP . "/controllers/appControllers.php";
// Carrega todos os arquivos existentes dentro da pasta Controlles
foreach (glob( _APP ."/controllers/*.php") as $filename)
{
    require_once $filename;
}

# === Autoload
# ==================================================
//require_once 'vendor/autoload.php';

require_once 'app/routes.php';

# === run slim
$app->run();

