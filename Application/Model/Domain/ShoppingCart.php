<?php

namespace Model\Domain;

class ShoppingCart extends Model
{
    private string $id;
    private array $articles;

    public function __construct()
    {
        $this->id = "";
        $this->articles = [];
    }

    /**
     * @return iterable
     */
    public function getArticles(): iterable
    {
        return $this->articles;
    }

    /**
     * add one article to the shopping cart
     *
     * @param Article $article
     * @return iterable
     */
    public function addArticle(Article $article): iterable
    {
        $this->articles[$article->getId()] = $article;
        return $this->articles;
    }

    /**
     * remove one article from the shopping cart
     *
     * @param string $article_id
     * @return iterable
     */
    public function removeArticle(string $article_id): iterable
    {
        if (in_array($article_id, $this->articles)) {
            array_splice($this->articles, $article_id, 1);
        }
    }
}
