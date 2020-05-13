<?php

namespace Model;

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
    public function getAll(): iterable
    {
        $query = $this->db->query("select * from Article");

        $articles = [];
        foreach ($query->fetchAll() as $queryResult) {
            $articles[] = self::mapQueryResultToArticle($queryResult);
        }
        return $articles;
    }

    /**
     * @param string $id
     * @return Domain\Article|null
     */
    public function getArticleById(string $id): ?\Model\Domain\Article
    {
        $statement = "select * from Article where article_id = :id";

        $query = $this->db->prepare($statement);

        $query->execute([":id" => $id]);
        $result = $query->fetch();
        return self::mapQueryResultToArticle($result);
    }

    /**
     * @param $result
     * @return Domain\Article
     */
    private static function mapQueryResultToArticle($result): Domain\Article
    {
        return new Domain\Article(
            $result["article_id"],
            $result["article_name"],
            $result["description"],
            $result["stock"],
            $result["image_path"]
        );
    }
}
