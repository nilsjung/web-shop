<?php

namespace Model;

use Controller\SessionController;
use MongoDB\Driver\Query;
use mysql_xdevapi\Exception;

/**
 * Class Article
 *
 * @package Model
 */
class Article extends Model
{
    /**
     * @return Domain\Article[]
     */
    public function getAll(): QueryResult
    {
        // TODO SQL: get all articles but count just them from the current shopping cart.
        $statement = "
        select a.article_id, article_name, IFNULL(aic.count,0) as count, stock, description, image_path
        from Article as a
        left outer JOIN  articles_in_cart aic on a.article_id = aic.article_id;
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
     * @return Domain\Article|null
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

    /**
     * @param $result
     * @return Domain\Article
     */
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
