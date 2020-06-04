<?php

namespace Model\Domain;

class Order extends Model
{
    private string $id;
    private float $total;
    private User $user;

    /**
     * Order constructor.
     * @param string $id
     * @param float $total
     * @param User $user
     */
    public function __construct(string $id, float $total, User $user)
    {
        $this->id = $id;
        $this->total = $total;
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
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
}
