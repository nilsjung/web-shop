<?php

namespace Model;

class User extends Model {
    public function getAllUser() {
        $query = $this->db->query("select * from User");
        return $query->fetchAll();
    }
}