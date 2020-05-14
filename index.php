<?php
/** Index
 *
 * This is the entry point of the application.
 * Here the autoloader includes the required classes,
 * the session manager starts a new session
 * and the routes are defined.
 *
 */

use Configuration\Configuration;
use Controller\SessionController;
use Model\Database;

require_once 'autoload.php';
require_once 'routes.php';

SessionController::start_session();

// create and render the navigation bar.
$navigation = new \View\NavigationView(null, null);
$sessionUser = SessionController::getAuthenticatedUserId();
$navigation->setProperties(["userId", $sessionUser]);
$body["navigation"] = $navigation->render();

/** Debug Mode
 * start debug mode to list the $_SESSION attributes. Alternatively you can replace the $_SESSION by $_SERVER
 *
 * TODO implement a Debugger class
 */
$isDebug = false;
$debug_key = "debug";
$body[$debug_key] = "<h2>Debug</h2><table class='table'><tbody>";
foreach ($_SERVER as $key => $value) {
    $body[$debug_key] .=
        "<tr><td class='mr-3'>" . $key . ':</td><td>' . $value . "</td></tr>";
}
$body[$debug_key] .= "</tbody></table>";
/** End Debug Mode */

require_once 'Public/Templates/Main.inc';
