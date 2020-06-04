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

    private function refreshPasswordHash(
        string $userId,
        string $password,
        string $storedHash
    ): QueryResult {
        $userResult = $this->getUserById($userId);

        if (password_needs_rehash($storedHash, PASSWORD_DEFAULT)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $user = $userResult->getResult();

            $user->setPassword($hash);

            return $this->model->updateUser($user);
        }

        return $userResult;
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
            $this->refreshPasswordHash(
                $user->getId(),
                $password,
                $user->getPassword()
            );
            return $userResult;
        } else {
            return new QueryResult(null, "Error during authentication");
        }
    }
}
