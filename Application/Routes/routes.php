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

/**
 * test if all params are part of the given object
 *
 * @param array $params
 * @param array $object
 * @return bool
 */
function isGiven(array $params, array $object)
{
    foreach ($params as $p) {
        if (!array_key_exists($p, $object)) {
            return false;
        }
    }

    return true;
}
