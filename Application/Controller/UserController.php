<?php

namespace Controller;

use Model\User;

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
    public function __construct(User $model)
    {
        parent::__constructor($model);
    }

    /**
     * @param String $id
     * @return User|null
     */
    public function getUserById(string $id): ?User
    {
        $this->model = $this->model->findById($id);
        return $this->model;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User
    {
        $this->model = $this->model->findByEmailAddress($email);
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
    ): ?User {
        $user = $this->getUserById($id);

        if (is_null($user)) {
            return null;
        }

        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmailAddress($emailAddress);
        $user->setPassword($password);

        $this->model = $user;

        $this->model->updateUser();

        return $user;
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
