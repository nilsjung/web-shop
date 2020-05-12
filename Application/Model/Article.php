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
