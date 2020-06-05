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
SessionController::startSession();
require_once "Application/root.php";
require_once 'Application/Routes/routes.php';

require_once 'Application/Templates/Main.inc';
