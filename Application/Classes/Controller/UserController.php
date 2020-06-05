<?php

namespace Controller;

use Model\Domain\User;
use Model\QueryResult;

/**
 * Class UserController
 *
 * @package Controller
 */
class UserController extends Controller
{
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
     * @param string $paymentMethod
     * @param string $password
     * @return QueryResult
     */
    public function updateUserById(
        string $id,
        string $firstName,
        string $lastName,
        string $emailAddress,
        string $paymentMethod,
        string $password
    ): QueryResult {
        $user = new \Model\Domain\User();

        $user->setId($id);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmailAddress($emailAddress);
        $user->setPaymentMethod($paymentMethod);

        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        return $this->model->updateUser($user);
    }

    /**
     * @param User $user
     * @param string $password
     * @return User
     */
    private function refreshPasswordHashIfNeeded(
        User $user,
        string $password
    ): User {
        if (password_needs_rehash($user->getPassword(), PASSWORD_DEFAULT)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $user->setPassword($hash);
            return $this->model->updateUser($user);
        }

        return $user;
    }

    /**
     * @param string $email
     * @param string $password
     * @return QueryResult
     */
    public function login(string $email, string $password): QueryResult
    {
        $userResult = $this->getUserByEmail($email);

        if ($userResult->hasError()) {
            return $userResult;
        }

        $user = $userResult->getResult();
        if (password_verify($password, $user->getPassword())) {
            $this->refreshPasswordHashIfNeeded($user, $password);
            return new QueryResult([$user], null);
        } else {
            return new QueryResult(null, "Error during authentication");
        }
    }
}
