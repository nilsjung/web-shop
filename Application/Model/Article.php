<?php

namespace Model;

class Article extends Model {
    public function getAll () {
        $query = $this->db->query("select * from Article");
        return $query->fetchAll();
    }
}