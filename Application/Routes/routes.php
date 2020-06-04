<?php
/**
 * Define the routes that handle the different user requests.
 */

$router = new Router\Router(new Router\Request());

require_once "subroutes/indexRoutes.php";
require_once "subroutes/loginRoutes.php";
require_once "subroutes/articleRoutes.php";
require_once "subroutes/shoppingCartRoutes.php";
require_once "subroutes/userRoutes.php";
require_once "subroutes/paymentRoutes.php";
