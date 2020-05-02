<?php

use Configuration\Configuration;
use Database\Database;

session_start();

require_once( 'autoload.php' );
require_once( 'routes.php' );

$navigation = new \View\NavigationView(null, null);
$body = $navigation->render();

require_once( 'Public/Templates/Main.inc' );

$configuration = Configuration::instance();
$database = Database::instance();

