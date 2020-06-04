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
    select a.article_id, article_name, aic.count, stock, price, description, image_path
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
                    Article::mapQueryResultToArticle($values)
                );
            }

            return new QueryResult([$shoppingCart], null);
        } catch (\PDOException $exception) {
            return new QueryResult(null, "internal error", 500);
        }
    }

    /**
     * @param string $shoppingCartId
     * @param string $articleId
     * @return QueryResult
     */
    public function addArticle(
        string $shoppingCartId,
        string $articleId
    ): QueryResult {
        $statement = "
            insert into articles_in_cart (shopping_cart_id, article_id)
            values (:shoppingCartId, :articleId)
            on duplicate key update count=count+1;
            ";

        $query = $this->db->prepare($statement);

        try {
            $query->execute([
                ":shoppingCartId" => $shoppingCartId,
                ":articleId" => $articleId,
            ]);
            return $this->getById($shoppingCartId);
        } catch (\PDOException $exception) {
            return new QueryResult(null, 'Could not update', 500);
        }
    }

    public function deleteArticle(
        string $shoppingCartId,
        string $articleId
    ): QueryResult {
        $statement = "
            delete from articles_in_cart where shopping_cart_id=:shoppingCartId and article_id=:articleId;
        ";

        $query = $this->db->prepare($statement);
        try {
            $query->execute([
                "shoppingCartId" => $shoppingCartId,
                "articleId" => $articleId,
            ]);
            return $this->getById($shoppingCartId);
        } catch (\PDOException $exception) {
            return new QueryResult(null, 'Could not delete article', 500);
        }
    }

    public function removeArticle(
        string $shoppingCartId,
        string $articleId
    ): QueryResult {
        $statement = "
            update articles_in_cart set count = count -1 where shopping_cart_id=:shoppingCartId and article_id=:articleId;
        ";

        $query = $this->db->prepare($statement);
        try {
            $query->execute([
                "shoppingCartId" => $shoppingCartId,
                "articleId" => $articleId,
            ]);
            return $this->getById($shoppingCartId);
        } catch (\PDOException $exception) {
            return new QueryResult(null, 'Could not delete article', 500);
        }
    }

    /**
     * @param string $id
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
}
