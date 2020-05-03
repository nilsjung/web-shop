<?php

namespace Model;

/**
 * Class User
 *
 * @package Model
 */
class User extends Model
{
    private $id;
    private $firstName;
    private $lastName;
    private $emailAddress;
    private $password;

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param mixed $emailAddress
     */
    public function setEmailAddress($emailAddress): void
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * updates the database entry
     */
    public function updateUser(): void
    {
        $query = $this->db->prepare(
            "UPDATE User set first_name = :first_name, last_name = :last_name, email_address = :email_address, password = :password WHERE user_id = :user_id"
        );

        $query->bindParam(":user_id", $this->id, \PDO::PARAM_STR);
        $query->bindParam(":first_name", $this->firstName, \PDO::PARAM_STR);
        $query->bindParam(":last_name", $this->lastName, \PDO::PARAM_STR);
        $query->bindParam(
            ":email_address",
            $this->emailAddress,
            \PDO::PARAM_STR
        );
        $query->bindParam(":password", $this->password, \PDO::PARAM_STR);

        if ($query->execute() === 1) {
            echo "error during update process";
            return;
        }
    }

    /**
     * return User[]
     */
    public function getAllUser(): array
    {
        $users = [];
        $query = $this->db->query("select * from User");

        foreach ($query->fetchAll() as $result) {
            $users[] = $this->resultToUser($result);
        }

        return $users;
    }

    /**
     * @param String $emailAddress
     * @return User
     */
    public function findByEmailAddress(string $emailAddress): ?User
    {
        $query = $this->db->prepare(
            "select * from User where email_address = :id "
        );
        $query->bindParam(":id", $emailAddress, \PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() == 0) {
            return null;
        }

        $result = $query->fetch();

        return $this->resultToUser($result);
    }

    /**
     * @param string $id
     * @return User|null
     */
    public function findById(string $id): ?User
    {
        $query = $this->db->prepare("select * from User where user_id = :id ");
        $query->bindParam(":id", $id, \PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() == 0) {
            return null;
        }

        $result = $query->fetch();

        return $this->resultToUser($result);
    }

    /**
     * @param array $result
     * @return User
     */
    private function resultToUser(array $result): User
    {
        $user = new User();

        $user->firstName = $result["first_name"];
        $user->lastName = $result["last_name"];
        $user->emailAddress = $result["email_address"];
        $user->password = $result["password"];
        $user->id = $result["user_id"];

        return $user;
    }
}
