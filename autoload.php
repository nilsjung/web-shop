<?php

// autoload files under "Application" by namespace and filename
function loader( $class ) {
    $pathSegments = explode('\\', $class);

    $DOCUMENT_ROOT = $_SERVER[ "DOCUMENT_ROOT" ];

    $path = $DOCUMENT_ROOT . '/Application/';

    foreach ( $pathSegments as $segment ) {
        $path = $path . "/" . $segment;
    }

    require_once $path . '.php';
}

spl_autoload_register('loader');