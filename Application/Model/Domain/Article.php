<?php

namespace Model\Domain;

class Article
{
    private string $id;
    private int $stock;
    private string $name;
    private string $description;
    private string $imagePath;

    /**
     * Article constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $imagePath
     */
    public function __construct($id, $name, $description, $stock, $imagePath)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->stock = $stock;
        $this->imagePath = $imagePath;
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
}
