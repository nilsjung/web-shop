<?php

use Configuration\Configuration;
use Model\Database;

session_start();

require_once( 'autoload.php' );
require_once( 'Public/routes.php' );

$navigation = new \View\NavigationView(null, null);

/** Debug Mode */
$isDebug = false;
$debug_key = "debug";
$body[ $debug_key ] = "<h2>Debug</h2><table class='table'><tbody>";
foreach ( $_SESSION as $key => $value ) {
    $body[ $debug_key ] .= "<tr><td class='mr-3'>" . $key . ':</td><td>' . $value . "</td></tr>";
}
$body[ $debug_key ] .= "</tbody></table>";
/** End Debug Mode */

$body[ "navigation" ] = $navigation->render();

require_once( 'Public/Templates/Main.inc' );
$configuration = Configuration::instance();
$database = Database::instance();

