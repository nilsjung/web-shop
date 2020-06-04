<?php

namespace Model\Domain;

class Payment extends Model
{
    private User $user;
    private ShoppingCart $shoppingCart;
    private string $paymentHash;

    public function __construct(User $user, ShoppingCart $shoppingCart)
    {
        $this->shoppingCart = $shoppingCart;
        $this->user = $user;
        $this->paymentHash = "";
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

    /**
     * @return string
     */
    public function getPaymentHash(): string
    {
        return $this->paymentHash;
    }

    /**
     * @param string $paymentHash
     */
    public function generatePaymentHash(string $secret): string
    {
        $this->paymentHash = md5(
            $this->user->getId() . $this->shoppingCart->getSum() . $secret
        );
        return $this->paymentHash;
    }
}
