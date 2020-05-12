<?php

namespace Controller;

/**
 * Class UserController
 *
 * @package Controller
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     *
     * @param User $model
     */
    public function __construct(\Model\Domain\User $model)
    {
        parent::__constructor($model);
    }

    /**
     * @param String $id
     * @return User|null
     */
    public function getUserById(string $id): ?\Model\Domain\User
    {
        $user = new \Model\User();

        $this->model = $user->findById($id);
        return $this->model;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?\Model\Domain\User
    {
        $user = new \Model\User();

        $this->model = $user->findByEmailAddress($email);
        return $this->model;
    }

    /**
     * @param string $id
     * @param string $firstName
     * @param string $lastName
     * @param string $emailAddress
     * @param string $password
     * @return User|null
     */
    public function updateUserById(
        string $id,
        string $firstName,
        string $lastName,
        string $emailAddress,
        string $password
    ): ?\Model\Domain\User {
        $user = new \Model\User();

        $this->model->setId($id);
        $this->model->setFirstName($firstName);
        $this->model->setLastName($lastName);
        $this->model->setEmailAddress($emailAddress);
        $this->model->setPassword($password);

        $user->updateUser($this->model);

        return $this->model;
    }

    /**
     * @param string $enteredPassword
     * @return bool
     */
    public function validatePassword(string $enteredPassword): bool
    {
        if (strcmp($this->model->getPassword(), $enteredPassword) === 0) {
            return true;
        }

        return false;
    }
}
