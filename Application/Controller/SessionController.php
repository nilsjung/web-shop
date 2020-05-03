<?php

namespace Controller;

/**
 * Class SessionController
 *
 * @package Controller
 */
class SessionController {

    /**
     * @var string
     */
    private static $authenticatedKey = "authenticated";
    /**
     * @var string
     */
    private static $authenticatedUserId = "user_id";

    /**
     *
     */
    public static function start_session() {
        session_start();
    }

    /**
     * @param bool $state
     */
    public static function setAuthenticatedState( bool $state ) : void {
        $_SESSION[ self::$authenticatedKey ] = $state;
    }

    /**
     * @return bool
     */
    public static function isAuthenticated() : bool {
        if ( !array_key_exists(self::$authenticatedKey, $_SESSION) ) {
            return false;
        }

        return $_SESSION[ self::$authenticatedKey ];
    }

    /**
     * @param $userId
     */
    public static function setAuthenticatedUserId( $userId ) : void {
        $_SESSION[ self::$authenticatedUserId ] = $userId;
    }

    /**
     * @return string|null
     */
    public static function getAuthenticatedUserId() : ?string {
        if ( array_key_exists(self::$authenticatedUserId, $_SESSION) ) {
            return $_SESSION[ self::$authenticatedUserId ];
        }

        return null;
    }
}