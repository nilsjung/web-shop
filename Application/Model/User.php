<?php

namespace Model;

/**
 * Class User
 *
 * @package Model
 */
class User extends Model {

    private $id;
    private $firstName;
    private $lastName;
    private $emailAddress;
    private $password;

    /**
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string {
        return $this->emailAddress;
    }

    /**
     * @return mixed
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * return []User
     */
    public function getAllUser() {
        $users = array();
        $query = $this->db->query("select * from User");

        foreach ( $query->fetchAll() as $result ) {
            $users[] = $this->resultToUser($result);
        }

        return $users;
    }

    /**
     * @param String $emailAddress
     * @return User
     */
    public function findByEmailAddress( string $emailAddress ): ?User {
        $query = $this->db->prepare("select * from User where email_address = :id ");
        $query->bindParam(":id", $emailAddress, \PDO::PARAM_STR);
        $query->execute();

        if ( $query->rowCount() == 0 ) {
            return null;
        }

        $result = $query->fetch();

        return $this->resultToUser($result);
    }

    /**
     * @param string $id
     * @return User|null
     */
    public function findById( string $id ): ?User {
        $query = $this->db->prepare("select * from User where user_id = :id ");
        $query->bindParam(":id", $id, \PDO::PARAM_STR);
        $query->execute();

        if ( $query->rowCount() == 0 ) {
            return null;
        }

        $result = $query->fetch();

        return $this->resultToUser($result);
    }

    /**
     * @param array $result
     * @return User
     */
    private function resultToUser( Array $result ): User {
        $user = new User();

        $user->firstName = $result[ "first_name" ];
        $user->lastName = $result[ "last_name" ];
        $user->emailAddress = $result[ "email_address" ];
        $user->password = $result[ "password" ];
        $user->id = $result[ "user_id" ];

        return $user;
    }
}