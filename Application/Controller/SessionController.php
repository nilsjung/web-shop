<?php

namespace Controller;

class SessionController {

    private static $authenticatedKey = "authenticated";
    private static $authenticatedUserId = "user_id";

    public static function start_session() {
        session_start();
    }

    public static function setAuthenticatedState( bool $state ) : void {
        $_SESSION[ self::$authenticatedKey ] = $state;
    }

    public static function isAuthenticated() : bool {
        if ( !array_key_exists(self::$authenticatedKey, $_SESSION) ) {
            return false;
        }

        return $_SESSION[ self::$authenticatedKey ];
    }

    public static function setAuthenticatedUserId( $userId ) : void {
        $_SESSION[ self::$authenticatedUserId ] = $userId;
    }

    public static function getAuthenticatedUserId() : ?string {
        if ( array_key_exists(self::$authenticatedUserId, $_SESSION) ) {
            return $_SESSION[ self::$authenticatedUserId ];
        }

        return null;
    }
}