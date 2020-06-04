<?php

namespace Model;

use Controller\SessionController;

/**
 * Class Article
 *
 * @package Model
 */
class Article extends Model
{
    /**
     * @return QueryResult
     */
    public function getAll(): QueryResult
    {
        $statement = "
        select aic.shopping_cart_id,
            a.article_id,
            article_name,
            IFNULL(aic.count, 0) as count,
            stock,
            price,
            description,
            image_path
        from Article as a
            left outer JOIN (
                select * from articles_in_cart where shopping_cart_id = :shoppingCartId
            ) as aic
        on a.article_id = aic.article_id
        ";

        $query = $this->db->prepare($statement);
        try {
            $query->execute([
                ":shoppingCartId" => SessionController::getShoppingCartId(),
            ]);

            $articles = [];

            foreach ($query->fetchAll() as $queryResult) {
                $articles[] = self::mapQueryResultToArticle($queryResult);
            }

            return new QueryResult($articles, null);
        } catch (\PDOException $exception) {
            return new QueryResult(null, 'Internal Error', 500);
        }
    }

    /**
     * @param string $id
     * @return QueryResult
     */
    public function getArticleById(string $id): QueryResult
    {
        $statement = "select * from Article where article_id = :id";

        $query = $this->db->prepare($statement);

        try {
            $query->execute([":id" => $id]);
            $result = $query->fetch();
            $article = self::mapQueryResultToArticle($result);
            return new QueryResult([$article], null);
        } catch (\PDOException $exception) {
            return new QueryResult(null, 'Internal Server Error', 500);
        }
    }

    public function reduceStock(array $articles): void
    {
        $statement = "";

        $reindexed = [];
        $counter = 0;
        foreach ($articles as $key => $article) {
            $reindexed[$counter] = $article;
            $statement .=
                "update Article set stock = stock - :stock" .
                $counter .
                " where article_id = :id" .
                $counter .
                "; ";
            $counter++;
        }

        $query = $this->db->prepare($statement);
        foreach ($reindexed as $key => $article) {
            $query->bindValue(":stock" . $key, $article->getInCart());
            $query->bindValue(":id" . $key, $article->getId());
        }

        try {
            $query->execute();
        } catch (\PDOException $exception) {
            die("Error during update process");
        }
    }

    /**
     * @param $result
     * @return Domain\Article
     */
    public static function mapQueryResultToArticle($result): Domain\Article
    {
        $article = new Domain\Article(
            $result["article_id"],
            $result["article_name"],
            $result["description"],
            $result["stock"],
            $result["price"],
            $result["image_path"]
        );

        if (array_key_exists("count", $result)) {
            $article->setInCart($result["count"]);
        } else {
            $article->setInCart(0);
        }
        return $article;
    }
}
