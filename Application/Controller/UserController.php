<?php

namespace Controller;

use Model\QueryResult;

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
     * @return QueryResult
     */
    public function getUserById(string $id): QueryResult
    {
        return $this->model->findById($id);
    }

    /**
     * @param string $email
     * @return QueryResult
     */
    public function getUserByEmail(string $email): QueryResult
    {
        return $this->model->findByEmailAddress($email);
    }

    /**
     * @param string $id
     * @param string $firstName
     * @param string $lastName
     * @param string $emailAddress
     * @param string $password
     * @return QueryResult
     */
    public function updateUserById(
        string $id,
        string $firstName,
        string $lastName,
        string $emailAddress,
        string $password
    ): QueryResult {
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
     * @param \Model\Domain\User $user
     * @return bool
     */
    public function validatePassword(
        string $enteredPassword,
        \Model\Domain\User $user
    ): bool {
        if (strcmp($user->getPassword(), $enteredPassword) === 0) {
            return true;
        }

        return false;
    }
}
