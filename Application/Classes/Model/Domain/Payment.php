<?php

namespace Model\Domain;

class Payment extends Model
{
    private User $user;
    private ShoppingCart $shoppingCart;

    public function __construct(User $user, ShoppingCart $shoppingCart)
    {
        $this->shoppingCart = $shoppingCart;
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return ShoppingCart
     */
    public function getShoppingCart(): ShoppingCart
    {
        return $this->shoppingCart;
    }

    /**
     * @param ShoppingCart $shoppingCart
     */
    public function setShoppingCart(ShoppingCart $shoppingCart): void
    {
        $this->shoppingCart = $shoppingCart;
    }
}
