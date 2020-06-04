<?php

namespace Model\Domain;

class Article extends Model
{
    private string $id;
    private int $stock;
    private int $in_cart;
    private string $name;
    private string $description;
    private string $imagePath;
    private float $price;

    /**
     * Article constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $stock
     * @param $price
     * @param $imagePath
     */
    public function __construct(
        $id,
        $name,
        $description,
        $stock,
        $price,
        $imagePath
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->stock = $stock;
        $this->price = $price;
        $this->imagePath = $imagePath;
        $this->in_cart = 0;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param mixed $imagePath
     */
    public function setImagePath($imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getInCart(): int
    {
        return $this->in_cart;
    }

    /**
     * @param int $in_cart
     */
    public function setInCart(int $in_cart): void
    {
        $this->in_cart = $in_cart;
    }
}
