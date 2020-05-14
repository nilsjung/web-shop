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
    public function getById(string $id): QueryResult
    {
        $statement = "
    select a.article_id, article_name, aic.count, stock, description, image_path
    from ShoppingCart as sc, articles_in_cart as aic, Article as a
    where sc.shopping_cart_id = :id and sc.shopping_cart_id = aic.shopping_cart_id and a.article_id = aic.article_id;
    ";
        $query = $this->db->prepare($statement);

        try {
            $query->execute([":id" => $id]);
            $result = $query->fetchAll();

            $shoppingCart = new Domain\ShoppingCart($id);

            foreach ($result as $values) {
                $shoppingCart->addArticle(
                    self::mapQueryResultToArticle($values)
                );
            }

            return new QueryResult([$shoppingCart], null);
        } catch (\PDOException $exception) {
            return new QueryResult(null, "internal error", 500);
        }
    }

    public function addArticle(
        string $shoppingCartId,
        string $articleId
    ): QueryResult {
        $statement =
            "insert into articles_in_cart (shopping_cart_id, article_id) values (:shoppingCartId, :articleId)";
        $query = $this->db->prepare($statement);
        try {
            $query->execute([
                ":shoppingCartId" => $shoppingCartId,
                ":articleId" => $articleId,
            ]);
            return $this->getById($shoppingCartId);
        } catch (\PDOException $exception) {
            return new QueryResult(null, 'Internal Error');
        }
    }

    /**
     * @param Domain\ShoppingCart $shoppingCart
     */
    public function save(string $id): void
    {
        $statement = "insert into ShoppingCart (shopping_cart_id) values (:id)";

        $query = $this->db->prepare($statement);

        try {
            $query->execute([":id" => $id]);
        } catch (\PDOException $e) {
            echo $e->getMessage();
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
