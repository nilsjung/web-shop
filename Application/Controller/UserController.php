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
    public function __construct(\Model\User $model)
    {
        parent::__constructor($model);
    }

    /**
     * @param String $id
     * @return User|null
     */
    public function getUserById(string $id): ?\Model\Domain\User
    {
        return $this->model->findById($id);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?\Model\Domain\User
    {
        return $this->model->findByEmailAddress($email);
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
        $user = new \Model\Domain\User();

        $user->setId($id);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmailAddress($emailAddress);
        $user->setPassword($password);

        return $this->model->updateUser($user);
    }

    /**
     * @param string $enteredPassword
     * @return bool
     */
    public function validatePassword(
        string $enteredPassword,
        \Model\DOmain\User $user
    ): bool {
        if (strcmp($user->getPassword(), $enteredPassword) === 0) {
            return true;
        }

        return false;
    }
}
