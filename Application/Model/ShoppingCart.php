<?php

namespace Model;

/**
 * Class User
 *
 * @package Model
 */
class ShoppingCart extends Model
{
    public function getById(string $id): ?Domain\ShoppingCart
    {
        $statement = "
    select a.article_id, article_name, aic.count, stock, description, image_path
    from ShoppingCart as sc, articles_in_cart as aic, Article as a
    where sc.shopping_cart_id = :id and sc.shopping_cart_id = aic.shopping_cart_id and a.article_id = aic.article_id;
    ";
        $query = $this->db->prepare($statement);
        $query->execute([":id" => $id]);

        $result = $query->fetchAll();

        $shoppingCart = new Domain\ShoppingCart();

        foreach ($result as $values) {
            $shoppingCart->addArticle(self::mapQueryResultToArticle($values));
        }

        return $shoppingCart;
    }

    public function save(\Model\Domain\ShoppingCart $shoppingCart): void
    {
        $statement = "insert into ShoppingCart (shopping_cart_id) values (:id)";

        $query = $this->db->prepare($statement);
        $query->execute([":id" => $shoppingCart->getId()]);
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
