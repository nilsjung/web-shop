<?php

namespace Model;

/**
 * Class Article
 *
 * @package Model
 */
class Article extends Model {
    /**
     * @return array
     */
    public function getAll() {
        $query = $this->db->query("select * from Article");
        return $query->fetchAll();
    }
}