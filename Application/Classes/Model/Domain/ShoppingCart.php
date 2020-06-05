<?php

namespace Model\Domain;

class ShoppingCart extends Model
{
    private string $id;
    private array $articles;

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->articles = [];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Article[]
     */
    public function getArticles(): iterable
    {
        return $this->articles;
    }

    public function getArticle(string $articleId): ?Article
    {
        if (key_exists($articleId, $this->articles)) {
            return $this->articles[$articleId];
        }
        return null;
    }

    /**
     * add one article to the shopping cart
     *
     * @param Article $article
     * @return iterable
     */
    public function addArticle(Article $article): ShoppingCart
    {
        $this->articles[$article->getId()] = $article;
        $article->setInCart($article->getInCart() + 1);
        return $this;
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

    public function getSum(): float
    {
        $sum = 0.0;
        $articles = $this->getArticles();
        foreach ($articles as $article) {
            $sum += $article->getPrice() * $article->getInCart();
        }

        return $sum;
    }
}
