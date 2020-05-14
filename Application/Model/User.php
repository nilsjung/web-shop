<?php

namespace Model;

use MongoDB\Driver\Query;

/**
 * Class User
 *
 * @package Model
 */
class User extends Model
{
    /**
     * updates the database entry
     * @param Domain\User $user
     */
    public function updateUser(\Model\Domain\User $user): QueryResult
    {
        $firstName = $user->getFirstName();
        $id = $user->getId();
        $lastName = $user->getLastName();
        $email = $user->getEmailAddress();
        $password = $user->getPassword();

        $query = $this->db->prepare(
            "UPDATE User set first_name = :first_name, last_name = :last_name, email_address = :email_address, password = :password WHERE user_id = :user_id"
        );

        $query->bindParam(":user_id", $id, \PDO::PARAM_STR);
        $query->bindParam(":first_name", $firstName, \PDO::PARAM_STR);
        $query->bindParam(":last_name", $lastName, \PDO::PARAM_STR);
        $query->bindParam(":email_address", $email, \PDO::PARAM_STR);
        $query->bindParam(":password", $password, \PDO::PARAM_STR);

        if ($query->execute() === 1) {
            echo "error during update process";
            return new QueryResult(null, 'Error while updating', 500);
        }

        return new QueryResult([$user], null);
    }

    /**
     * return Domain\User[]
     */
    public function getAllUser(): QueryResult
    {
        $query = $this->db->query("select * from User");
        $users = [];

        foreach ($query->fetchAll() as $result) {
            $users[] = self::mapQueryResultToUser($result);
        }

        return new QueryResult($users, null);
    }

    /**
     * @param String $emailAddress
     * @return User
     */
    public function findByEmailAddress(string $emailAddress): QueryResult
    {
        $query = $this->db->prepare(
            "select * from User where email_address = :id "
        );
        $query->bindParam(":id", $emailAddress, \PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() == 0) {
            return new QueryResult(null, "Login Error");
        }

        $result = self::mapQueryResultToUser($query->fetch());

        return new QueryResult([$result], null);
    }

    /**
     * @param string $id
     * @return User|null
     */
    public function findById(string $id): QueryResult
    {
        $query = $this->db->prepare("select * from User where user_id = :id ");
        $query->bindParam(":id", $id, \PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() == 0) {
            return new QueryResult(null, 'No user found');
        }

        $result = $this->mapQueryResultToUser($query->fetch());

        return new QueryResult([$result], null);
    }

    /**
     * @param array $result
     * @return User
     */
    private static function mapQueryResultToUser(array $result): Domain\User
    {
        $user = new Domain\User();

        $user->setFirstName($result["first_name"]);
        $user->setLastName($result["last_name"]);
        $user->setEmailAddress($result["email_address"]);
        $user->setPassword($result["password"]);
        $user->setId($result["user_id"]);

        return $user;
    }
}
