<?php

namespace Model;

/**
 * Class User
 *
 * @package Model
 */
class ShoppingCart extends Model
{
    /**
     * @param string $id
     * @return Domain\ShoppingCart|null
     */
    public function getById(string $id): ?Domain\ShoppingCart
    {
        $statement = "
    select a.article_id, article_name, aic.count, stock, description, image_path
    from ShoppingCart as sc, articles_in_cart as aic, Article as a
    where sc.shopping_cart_id = :id and sc.shopping_cart_id = aic.shopping_cart_id and a.article_id = aic.article_id;
    ";
        $query = $this->db->prepare($statement);

        try {
            $query->execute([":id" => $id]);
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }

        $result = $query->fetchAll();

        $shoppingCart = new Domain\ShoppingCart($id);

        foreach ($result as $values) {
            $shoppingCart->addArticle(self::mapQueryResultToArticle($values));
        }

        return $shoppingCart;
    }

    /**
     * @param Domain\ShoppingCart $shoppingCart
     */
    public function save(\Model\Domain\ShoppingCart $shoppingCart): void
    {
        $statement = "insert into ShoppingCart (shopping_cart_id) values (:id)";

        $query = $this->db->prepare($statement);

        try {
            $query->execute([":id" => $shoppingCart->getId()]);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param Domain\ShoppingCart $shoppingCart
     */
    public function update(\Model\Domain\ShoppingCart $shoppingCart): void
    {
        $articles = $shoppingCart->getArticles();
        $shoppingCartId = $shoppingCart->getId();

        $statement =
            "insert into articles_in_cart (shopping_cart_id, article_id) values (:shopping_cart_id, :article_id, :count);";

        foreach ($articles as $article) {
            $query = $this->db->prepare($statement);
            $query->bindValue(":shopping_cart_id", $shoppingCartId);
            $query->bindValue(":article_id", $article->getId());
            $query->bindValue(":count", $article->getInCart());
            try {
                $query->execute();
            } catch (\PDOException $e) {
                $error = $e->getMessage();
            }
        }
    }

    private static function mapQueryResultToArticle($result): Domain\Article
    {
        $article = new Domain\Article(
            $result["article_id"],
            $result["article_name"],
            $result["description"],
            $result["stock"],
            $result["image_path"]
        );

        $article->setInCart($result["count"]);
        return $article;
    }
}
