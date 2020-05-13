<?php

namespace Controller;

/**
 * Class SessionController
 *
 * @package Controller
 */
class SessionController
{
    /**
     * @var string
     */
    private static $authenticatedKey = "authenticated";
    /**
     * @var string
     */
    private static $authenticatedUserId = "user_id";

    private static $shoppingCartKey = "shopping_cart_id";

    /**
     *
     */
    public static function start_session()
    {
        session_start();
        self::createShoppingCart();
    }

    /**
     * @param bool $state
     */
    public static function setAuthenticatedState(bool $state): void
    {
        $_SESSION[self::$authenticatedKey] = $state;
    }

    /**
     * @return bool
     */
    public static function isAuthenticated(): bool
    {
        if (!array_key_exists(self::$authenticatedKey, $_SESSION)) {
            return false;
        }

        return $_SESSION[self::$authenticatedKey];
    }

    /**
     * @param $userId
     */
    public static function setAuthenticatedUserId($userId): void
    {
        $_SESSION[self::$authenticatedUserId] = $userId;
    }

    /**
     * @return string|null
     */
    public static function getAuthenticatedUserId(): ?string
    {
        if (array_key_exists(self::$authenticatedUserId, $_SESSION)) {
            return $_SESSION[self::$authenticatedUserId];
        }

        return null;
    }

    /**
     * @return string|null
     */
    public static function getShoppingCartId(): ?string
    {
        if (array_key_exists(self::$shoppingCartKey, $_SESSION)) {
            return $_SESSION[self::$shoppingCartKey];
        }

        return null;
    }

    /**
     * @return \Model\Domain\ShoppingCart|null
     */
    public static function createShoppingCart(): ?\Model\Domain\ShoppingCart
    {
        if (array_key_exists(self::$shoppingCartKey, $_SESSION)) {
            return null;
        }

        $shoppingCart = \Model\Domain\ShoppingCart::withId();
        $shoppingCart->save();

        $_SESSION[self::$shoppingCartKey] = $shoppingCart->getId();

        return $shoppingCart;
    }
}
